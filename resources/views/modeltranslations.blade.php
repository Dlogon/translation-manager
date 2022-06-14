@extends('translation-manager::layouts.translation-layout')

@section('header')
    @parent
    <h2 class="font-semibold text-xl text-gray-300 leading-tight">
        {{ __('Langs') }}
    </h2>
@endsection

@section('content')
    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
        <div class="bg-green-200 text-gray-700">
            Model traslations
        </div>
    </div>

    <div class="flex flex-row items-center">
        <form action="modeltranslationsgroups" method="POST">
            @csrf
            <button
                class="flex-shrink-0 bg-yellow-500 hover:bg-yellow-700 border-teal-500 hover:border-teal-700 text-lg border-4 text-white py-3 px-3 rounded"
                type="submit">
                <span class="animate-pulse">Generate model groups!</span>
            </button>
        </form>
    </div>

    <div class="flex flex-row items-center">
        <div>
            <label>Select a model group</label>
            <select id="group_id" class="text-gray-700">
                <option value="">Select </option>
                @foreach ($models as $namespace => $modelsNamespace)
                    @foreach ($modelsNamespace as $model)
                    <option >({{$namespace}}){{ $model }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>
    <div>SELECTED Model: <span id="selected_group">None</span></div>


@endsection


