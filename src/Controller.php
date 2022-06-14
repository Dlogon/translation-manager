<?php

namespace Dlogon\TranslationManager;

use Illuminate\Routing\Controller as BaseController;
use Dlogon\TranslationManager\Models\Group;
use Dlogon\TranslationManager\Models\Translation;
use Dlogon\TranslationManager\Models\Languaje;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Dlogon\TailwindAlerts\Facades\TailwindAlerts;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class Controller extends BaseController
{
    protected $app;
    protected $files;

    public function __construct(Application $app, Filesystem $files)
    {
        $this->app = $app;
        $this->files = $files;
    }

    public function index()
    {
        $groups = Group::all();
        $langs = Languaje::all();
        $traslations = Translation::all();
        return view('translation-manager::translations', compact("groups", "langs", "traslations"));
    }

    public function getLangs()
    {
        return Languaje::all();
    }

    public function addLang(Request $request)
    {
        $lang = new Languaje();
        $lang->name = $request->lang_name;
        $lang->save();
        TailwindAlerts::addSessionMessage("Lang added succesfully", TailwindAlerts::SUCCESS);
        return redirect()->back();
    }

    public function getGroupKeys(Request $request, $group = null)
    {
        $query = Translation::query();
        if(!$group)
            $group = 1;
        $query->whereRelation("group", "id", "=", $group);
        $traslations = $query->get("*");
        $traslations = $traslations->mapToGroups(function ($item, $key) {
            return [$item['key'] => $item];
        });

        return $traslations->toArray();
    }

    public function addTranslation(Request $request)
    {
        $traslation = new Translation;
        $traslation->languaje_id = $request->languaje_id;
        $traslation->group_id = $request->group_id;
        $traslation->key = $request->key;
        $traslation->value = $request->value;
        $traslation->save();
        TailwindAlerts::addSessionMessage("Translation added succesfully", TailwindAlerts::SUCCESS);
        return $traslation;
    }

    public function updateTranslation(Request $request)
    {
        $traslation = Translation::findOrFail($request->traslationId);
        $traslation->languaje_id = $request->languaje_id;
        $traslation->group_id = $request->group_id;
        $traslation->key = $request->key;
        $traslation->value = $request->value;
        $traslation->save();

        TailwindAlerts::addSessionMessage("Translation updated successfully", TailwindAlerts::SUCCESS);

        return $traslation;
    }

    public function createTranslationsFiles()
    {
        $groups = Group::all();
        $langs = Languaje::all();
        $langPath = $this->app['path.lang'];

    foreach($langs as $lang)
    {
        $langName = $lang->name;
        $langFolder =  rtrim($langPath.DIRECTORY_SEPARATOR.$langName, DIRECTORY_SEPARATOR);
        if (! is_dir($langFolder)) {
            mkdir($langFolder, 0777, true);
        }

        foreach($groups as $group)
        {
            $path = $langPath.DIRECTORY_SEPARATOR.$langName.DIRECTORY_SEPARATOR.$group->group_name.'.php';
            $translations =  $group->translations()->where("languaje_id", $lang->id)->get(["key", "value"])->pluck("value", "key")->toArray();
            $output = "<?php\n\nreturn ".var_export($translations, true).';'.\PHP_EOL;
            try {
                $pass = $this->files->put($path, $output);

            } catch (\Throwable $th) {
                throw $th;
            }

        }
    }
    TailwindAlerts::addSessionMessage("Translations files created successfully", TailwindAlerts::SUCCESS);

    return redirect()->back();
    }

    public function addKey(Request $request)
    {
        $key = $request->key;
        $group_id = $request->group_id;

        $existKey = Translation::where("group_id", $group_id)->where("key", $key)->get();
        if($existKey->count())
            return redirect()->back();
        $traslations = $request->langkeys;
        foreach($traslations as $lang_id => $value)
        {
            $traslation = new Translation;
            $traslation->languaje_id = $lang_id;
            $traslation->group_id = $group_id;
            $traslation->key = $key;
            $traslation->value =  $value;
            $traslation->save();
        }
        TailwindAlerts::addSessionMessage("Key added succesfully", TailwindAlerts::SUCCESS);
        return redirect()->back();
    }

    public function modelTranslations()
    {
        $models = $this->getModelNames();
        return view("translation-manager::modeltranslations", compact("models"));
    }

    public function modelTransationGroups()
    {
        $models = $this->getModelNames();
        foreach($models as $namespace => $modelsNamesPace)
        {
            foreach($modelsNamesPace as $model)
            {
                $group = new Group();
                $group->group_name = $model;
                $group->group_type = Group::MODEL_TYPE;
                $group->save();
                $modelNamespace = $namespace.$model;

                $modelInstance = new $modelNamespace;
                $table = $modelInstance->getTable();

                $ignoredModelColumns = config("traslations.ignore_model_columns")[$table] ?? [];
                $ignoredColumns = config("traslations.ignore_columns", ["id"]);
                $tableColumns = Schema::getColumnListing($table);
                $columns = array_diff($tableColumns, $ignoredColumns, $ignoredModelColumns);
                foreach($columns as $column)
                {
                    $traslation = new Translation;
                    $traslation->languaje_id = 1;
                    $traslation->group_id = $group->id;
                    $traslation->key = $column;
                    $traslation->value = "";
                    $traslation->save();
                }
            }

        }
        TailwindAlerts::addSessionMessage("model groups created successfully", TailwindAlerts::SUCCESS);

    }

    private function getModelNames(): array
    {
        $models = [];
        $modelsPaths = config("traslations.models_folder", ["App\\Models\\" => app_path('Models')]);

        foreach($modelsPaths as $namespace => $path)
        {
            $models[$namespace] = [];
            $modelFiles = File::allFiles($path);
            foreach ($modelFiles as $modelFile) {
                $modelName = $modelFile->getFilenameWithoutExtension();
                $models[$namespace][] =  $modelName;
            }
        }
        return $models;
    }
}
