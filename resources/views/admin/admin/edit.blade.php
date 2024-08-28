@extends('admin.layouts')
@section('content')
<style>
    #tags-input {
        display: inline-block;
    }

    #tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        border: 1px solid #ccc;
        padding: 0.25rem;
        border-radius: 0.25rem;
    }

    .tag {
        background-color: #f2f2f2;
        padding: 0.25rem 0.5rem;
        border-radius: 0.50rem;
        display: inline-flex;
        align-items: center;
    }

    .tag-text {
        margin-right: 0.25rem;
    }

    .tag-close {
        cursor: pointer;
        font-weight: bold;
        color: #999;
        font-size: 0.8rem;
    }

    #tags-suggestions {
        max-height: 8rem;
        overflow-y: auto;
    }

</style>

<div class="container mx-auto px-8">
<div class="mb-4">
    <a class="px-3 py-2 bg-blue-500 text-white text-black shadow-2xl" href="{{ route('admin.admin.index') }}">Back</a>
</div>
@if (Session::has('success'))
<div class="text-green-600 text-2xl m-3 w-full text-center">
     <p class=""><span class="font-bold">{{ Session::get('success') }} </span></p>
</div>
@endif
<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="w-full min-w-sm">
        <form  method="POST" action="{{ route('admin.admin.update',$admin->id) }}" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex flex-col gap-4 justify-between">
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Username
                    </label>
                    <input readonly disabled value="{{ $admin->email }} ( Can't Editable )"   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                    <small>@error('email') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Full name
                    </label>
                    <input name="name" value="{{ $admin->name }}"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
                    <small>@error('name') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Old Password
                    </label>
                    <input name="current_password"  class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                    <small>@error('current_password') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     New Password
                    </label>
                    <input name="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                    <small>@error('password') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                     Confirm Password
                    </label>
                    <input name="password_confirmation" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password">
                    <small>@error('password_confirmation') <p class="text-red-500">{{ $message }}</p>  @enderror</small>
                </div>
                @if ($admin->role=='staff')
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Current Permission Roles  </label>
                        <input type="text" readonly value="{{ implode(' , ', $admin->roles->pluck('name')->toArray()) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <input type="hidden" name="editTagID" value="{{ implode(' , ', $admin->roles->pluck('id')->toArray()) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                <div class="mb-4 flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Update Permission Roles  </label>
                        <input type="text" id="tags" placeholder="Enter tags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div id="tags-suggestions" class="mt-2 bg-white border border-gray-300 rounded-lg shadow-md hidden">
                        </div>
                    <div id="tags-container" class="mt-2">
                    </div>
                    <div id="tags-id-container">

                    </div>
                </div>
                @endif
            </div>
          <div class="flex items-center justify-between">
            @csrf
            @method('PATCH')
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Update
            </button>
          </div>
        </form>
      </div>
</div>
</div>

<script>
    const tagsInput = document.getElementById('tags');
    const tagsSuggestions = document.getElementById('tags-suggestions');
    const tagsContainer = document.getElementById('tags-container');
    const tagsIdContainer = document.getElementById('tags-id-container');

    const predefinedTags = [
        @foreach($roles as $role)
            { id: {{ $role->id }}, name: '{{ $role->name }}' },
        @endforeach
    ];

    function showTagsSuggestions(matchedTags) {
        const suggestionsHTML = matchedTags.map(tag => `<div class="p-2 cursor-pointer hover:bg-gray-100">${tag.name}</div>`).join('');
        tagsSuggestions.innerHTML = suggestionsHTML;
        tagsSuggestions.classList.remove('hidden');
    }

    function hideTagsSuggestions() {
        tagsSuggestions.innerHTML = '';
        tagsSuggestions.classList.add('hidden');
    }

    tagsInput.addEventListener('input', () => {
        const inputValue = tagsInput.value.toLowerCase().trim();
        const matchedTags = predefinedTags.filter(tag => tag.name.includes(inputValue));

        if (matchedTags.length > 0) {
            showTagsSuggestions(matchedTags);
        } else {
            hideTagsSuggestions();
        }
    });

    tagsInput.addEventListener('focus', () => {
        if (predefinedTags.length > 0) {
            showTagsSuggestions(predefinedTags);
        }
    });

    document.addEventListener('click', event => {
        if (!tagsInput.contains(event.target) && !tagsSuggestions.contains(event.target)) {
            hideTagsSuggestions();
        }
    });

    tagsSuggestions.addEventListener('click', event => {
        if (event.target.tagName === 'DIV') {
            const selectedTag = event.target.textContent;
            const selectedTagObject = predefinedTags.find(tag => tag.name === selectedTag);
            if (selectedTagObject && !tagsContainer.querySelector(`[data-tag="${selectedTagObject.id}"]`)) {
                addTag(selectedTagObject.id, selectedTagObject.name);
            }
            tagsInput.value = '';
            hideTagsSuggestions();
        }
    });

    tagsInput.addEventListener('keydown', event => {
        if (event.key === 'Enter' && tagsInput.value.trim() !== '') {
            const enteredTag = tagsInput.value.trim();
            const existingTag = predefinedTags.find(tag => tag.name === enteredTag);
            if (existingTag) {
                addTag(existingTag.id, existingTag.name);
            } else {
                // You can handle adding new tags if desired
            }
            tagsInput.value = '';
            event.preventDefault();
        }
    });

    tagsContainer.addEventListener('click', event => {
        if (event.target.classList.contains('tag-close')) {
            const tagIdToRemove = event.target.getAttribute('data-tag');
            const tagElement = event.target.parentElement;
            tagsContainer.removeChild(tagElement);
            // Remove corresponding tag ID from the tagsID container
            const tagIdElement = tagsIdContainer.querySelector(`[data-tag-id="${tagIdToRemove}"]`);
            if (tagIdElement) {
                tagsIdContainer.removeChild(tagIdElement);
            }
        }
    });

    function addTag(tagId, tagName) {
        const tagElement = document.createElement('div');
        tagElement.className = 'tag';
        tagElement.innerHTML = `
            <span class="tag-text">${tagName}</span>
            <span class="tag-close" data-tag="${tagId}">x</span>
        `;
        tagsContainer.appendChild(tagElement);

        // Create and append an input field with the selected tag ID
        const inputField = document.createElement('input');
        inputField.type = 'hidden';
        inputField.name = 'tagsID[]';
        inputField.value = tagId;
        inputField.setAttribute('data-tag-id', tagId); // Add data attribute for easy removal later
        tagsIdContainer.appendChild(inputField);
    }
</script>

@endsection
