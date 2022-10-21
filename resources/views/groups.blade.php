@extends('translation-manager::translation-layout')

@section('header')
    @parent
    <h2 class="font-semibold text-xl text-gray-300 leading-tight">
        {{ __('Groups') }}
    </h2>
@endsection

@section('content')
    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
        <div>
            <div class="bg-green-200 text-gray-700">
                ADD Group
            </div>
            <form class="w-full max-w-2xl" action="{{route(config('translation-manager.route.prefix').'.group.store')}}" method="POST">
                @csrf
                <div class="flex items-center border-bpy-2">
                    <label for="name">group</label>
                    <input name="name" class="w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                        type="text" placeholder="group" required>
                    <button
                        class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="submit">
                        Add
                    </button>
                </div>
            </form>

        </div>
        <br>
        <hr>

        <div class="flex flex-row items-center">
            <table class="table-fixed w-full">
                <thead class="text-sm font-semibold text-gray-800 bg-gray-300 divide-y divide-x">
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            group name
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groups as $group)
                        <tr>
                            <td>{{$group->id}}</td>
                            <td>{{$group->name}}</td>
                        </tr>
                    @empty
                        
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection

