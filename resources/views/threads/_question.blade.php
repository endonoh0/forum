{{-- Editing the queston --}}
<div class="card mb-4" v-if="editing">
    <div class="card-header">
        <div class="level">
            <input type="text" class="form-control" v-model="form.title">
        </div>
    </div>
{{-- Thread body --}}
    <div class="card-body">
        <div class="form-group">
            <wysiwyg class="editor-content" v-model="form.body" :value="form.body"></wysiwyg>
        </div>
    </div>
{{-- Thread Edit  --}}
    <div class="card-footer">
        <div class="level">
            <button class="btn-sm btn-outline-dark level-item" @click="editing = true" v-show="! editing">Edit</button>
            <button class="btn-sm btn-primary level-item" @click="update">Update</button>
            <button class="btn-sm btn-outline-dark level-item" @click="resetForm">Cancel</button>
    {{-- Delete thread --}}
            @can ('update', $thread)
                <form method="POST" class="ml-auto" action="{{ $thread->path() }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link">Delete Thread</button>
                </form>
            @endcan
        </div>
    </div>
</div>

{{-- Viewing the queston --}}
<div class="card mb-4" v-else>
    <div class="card-header">
        <div class="level">
{{-- Thread creator avatar --}}
            <img src="{{ $thread->creator->avatar_path }}"
                alt="{{ $thread->creator->name }}"
                width="25"
                height="25"
                class="mr-3">
{{-- Link to profile --}}
            <span class="flex">
                <a href="{{ route('profile', $thread->creator) }}">
                    {{ $thread->creator->name }}</a> posted: <span v-text="title"></span>
            </span>

        </div>
    </div>
{{-- Thread body --}}
    <div class="card-body editor-content" v-html="body"></div>
{{-- Thread Edit  --}}
    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn-sm btn-outline-dark" @click="editing = true">Edit</button>
    </div>
</div>
