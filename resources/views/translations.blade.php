@extends('translation-manager::translation-layout')

@section('header')
    @parent
    <h2 class="font-semibold text-xl text-gray-300 leading-tight">
        {{ __('Translations') }}
    </h2>
@endsection

@section('content')
    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
        <div class="flex items-center">
            <form action="{{route(config('translation-manager.route.prefix').'.generate')}}" method="POST">
                @csrf
                <button
                    class="flex-shrink-0 bg-yellow-500 hover:bg-yellow-700 border-teal-500 hover:border-teal-700 text-lg border-4 text-white py-3 px-3 rounded"
                    type="submit">
                    <span class="animate-pulse">Generate translations!</span>
                </button>
                <div>
                    <div>
                        <input id="default-radio-1" type="radio" value="PHP" name="lang_file_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-300 dark:text-gray-300">PHP</label>
                    </div>
                    <div>
                        <input checked id="default-radio-2" type="radio" value="JSON" name="lang_file_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-300 dark:text-gray-300">JSON</label>
                    </div>
                </div>
                
            </form>
        </div>

        <hr>
        <br>

        <div>
            <div class="bg-green-200 text-gray-700">
                ADD NEW Lang
            </div>
            <div>
                
                <form class="w-full max-w-2xl" action="{{route(config('translation-manager.route.prefix').'.lang.store')}}" method="POST">
                    @csrf
                    <div class="flex items-center border-bpy-2">
                        <label for="Key">Lang name</label>
                        <input name="lang_name" class="w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" placeholder="Key" required>
                        <button
                            class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                            type="submit">
                            Add
                        </button>
                    </div>
                </form>
    
            </div>
        </div>


        <div>
            <div class="bg-green-200 text-gray-700">
                ADD NEW KEY
            </div>
            <form class="w-full max-w-2xl" action="{{route(config('translation-manager.route.prefix').".key.store")}}" method="POST">
                @csrf
                <div class="flex items-center border-bpy-2">
                    <label for="Key">KEY</label>
                    <input name="key" class="w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text" placeholder="Key" required>
                    <label for="group">Group:</label>
                    <select name="group_id" required class="text-gray-700">
                        <option value="">Select a group</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    @foreach ($langs as $lang)
                        <label for="{{ $lang->name }}">{{ $lang->name }}:</label>
                        <input name="langkeys[{{ $lang->id }}]"
                            class="lang-key-value w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text">
                    @endforeach
                    <button
                        class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="submit">
                        Add
                    </button>
                </div>
            </form>

        </div>
        <div>
            <div class="bg-green-200 text-gray-700">
               &nbsp;
            </div>
            <label>Select a group to display their keys</label>
            <select id="group_id" class="text-gray-700">
                <option value="">Select, default is app</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            <div>SELECTED GROUP: <span id="selected_group">app</span></div>
        </div>

        <div class="flex flex-row items-center">
           
            <table id="lang_keys_table" class="table-fixed w-full">
                <thead class="text-sm font-semibold text-gray-800 bg-gray-300 divide-y divide-x">
                    <tr>
                        <th>
                            KEY:LANG
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <div id="form_containder" style="display: none">
            <div id="traslation_form" class="w-full max-w-sm bg-gray-100 dark:bg-gray-900">
                <div class="flex items-center border-b">
                    <input id="current_traslation"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text">
                    <button id="update_traslation_button"
                        class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="button">
                        Ok
                    </button>
                    <button id="cancel_button"
                        class="flex-shrink-0 bg-red-500 hover:bg-red-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="button">
                        Cancel
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", addListeners);

var currentLangs = [];
var editFormIsActive = false;
const form = document.getElementById("traslation_form");
var tdClicked = null;
var currentText = "";

function addListeners()
{
    group = document.getElementById("group_id");
    group.addEventListener("change", onChangeGroupActions);
    loadLangs();
    loadTraslatinosTable();
    tableOnclick();
    document.getElementById("update_traslation_button").addEventListener("click", clickOkUpdateTraslation);
    document.getElementById("cancel_button").addEventListener("click", clickCancelTraslation);
}

function clickOkUpdateTraslation(clickEvent)
{

    var groupId = tdClicked.dataset.groupId;
    var langId = tdClicked.dataset.langId;
    var traslationId = tdClicked.dataset.traslationId;
    var key = tdClicked.dataset.key;

    let value = form.querySelector("#current_traslation").value;
    let method = "POST";
    let url = "{{route(config('translation-manager.route.prefix').'.addTranslation')}}";
    let request = {
        "group_id" : groupId,
        "languaje_id" : langId,
        traslationId,
        key,
        value
    };
    if(traslationId != "0")
        method = "PUT";
    response = httpRequest(url, {"Content-Type": "application/json"}, method, request);
    AlertToast.showToast("translation Updated", AlertToast.SUCCESS);

    hideForm()
    tdClicked.innerHTML = value;
}

function clickCancelTraslation(clickEvent)
{
    hideForm();
    tdClicked.innerHTML = currentText
}

function tableOnclick()
{
    let table = document.getElementById("lang_keys_table");
    table.addEventListener("click", function(event){
        if(!event.target.classList.contains("edit-on-click"))
            return;
        if(editFormIsActive)
            return;
        editFormIsActive = true;
        tdClicked = event.target;
        currentText = tdClicked.innerHTML;

        var currentTextInput = form.querySelector("#current_traslation");
        form.style.width = tdClicked.width;
        form.style.height = tdClicked.height;
        currentTextInput.value = currentText;
        tdClicked.innerHTML = "";
        tdClicked.appendChild(form);
    });
}

function hideForm()
{
    let formContainer = document.getElementById("form_containder");
    let form = document.getElementById("traslation_form");
    formContainer.appendChild(form);
    editFormIsActive = false;
}

function onChangeGroupActions(event)
{
    let group = event.target;
    let selectedGroup = group.options[group.selectedIndex];
    let selectedGroupId = selectedGroup.value
    groupName = selectedGroup.text;
    document.getElementById("selected_group").innerHTML = ": " + group.options[group.selectedIndex].text;
    loadTraslatinosTable(selectedGroupId)
}

function loadLangs()
{
    let url = "{{route(config('translation-manager.route.prefix').'.lang')}}";
    let table = document.getElementById("lang_keys_table");
    langs = JSON.parse(httpRequest(url));
    langs.forEach(function(lang) {
        var row = document.createElement('th');
        row.dataset.lang = lang.name;
        row.dataset.langId = lang.id;
        row.innerHTML = lang.name;
        currentLangs.push(lang.name)

        table.querySelector("thead tr").appendChild(row);
      });
}

function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

function httpRequest(url, headers ={}, method = "GET", body = null)
{
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, false);

    let token = document.querySelector('meta[name="csrf-token"]').content

    xhr.setRequestHeader("X-CSRF-TOKEN", token);
    for(const head in headers)
    {
        xhr.setRequestHeader(head, headers[head]);
    }

    xhr.send(JSON.stringify(body));
    return xhr.responseText
}

function loadTraslatinosTable(groupId = "")
{
    let url = "{{route(config('translation-manager.route.prefix').'.group.keys')}}/" + groupId  ?? ""
    keys = JSON.parse(httpRequest(url));
    let tableBody = document.getElementById("lang_keys_table").getElementsByTagName('tbody')[0];;
    tableBody.innerHTML = "";
    for (const key in keys) {
        var row = tableBody.insertRow(-1);
        var keyCell = row.insertCell(0);
        keyCell.innerHTML = key
        var traslations = keys[key];
        var traslationGroupId = traslations[0]["group_id"] ?? 0;

        currentLangs.forEach(function(lang){

            let headerLang = document.querySelector('[data-lang="'+lang+'"]')
            let index = headerLang.cellIndex;
            let langId = headerLang.dataset.langId;
            let langValue = row.insertCell(index)
            let innerHtml = "EMPTY";
            let cssClass = "text-red-600";
            let traslationId = 0;
            let translationForLang = traslations.filter(t => t.languaje === lang)[0];

            langValue.classList.add("edit-on-click");

            if(translationForLang)
            {
                innerHtml = translationForLang.value;
                cssClass = "text-green-500";
                traslationId = translationForLang.id
            }
            langValue.innerHTML = innerHtml;
            langValue.dataset.groupId = traslationGroupId;
            langValue.dataset.langId = langId;
            langValue.dataset.traslationId = traslationId;
            langValue.dataset.key = key;


            langValue.classList.add(cssClass);
        })
    }

}
    </script>
@endpush
