<div class="page-wrapper">
    <div class="flex flex-col md:flex-row gap-2 justify-between">
        <input type="search" class="input input-bordered" placeholder="Pencarian">
        <button class="btn btn-primary" wire:click="$dispatch('createPost')">
            <x-tabler-plus class="size-5" />
            <span>Buat postingan</span>
        </button>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <th>No</th>
                <th>Judul</th>
                <th class="text-center">Show</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="flex items-start gap-3">
                                <div>
                                    <div class="avatar">
                                        <div class="w-8 rounded">
                                            <img src="{{ $data->image_url }}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="line-clamp-1">{{ Str::limit($data->title, 40) }}</div>
                                    <div class="text-xs opacity-50">{{ $data->user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex justify-center">
                                <input type="checkbox" class="toggle toggle-sm toggle-primary"
                                    @checked($data->show) wire:change="toggleShowPost({{ $data->id }})" />
                            </div>
                        </td>
                        <td>
                            <div class="flex gap-1 self-center justify-center">
                                <a href="{{ route('post.show', $data->id) }}" class="btn btn-xs btn-square btn-primary">
                                    <x-tabler-folder class="w-4 h-4" />
                                </a>
                                <a href="{{ route('post.edit', $data->id) }}" class="btn btn-xs btn-square btn-success">
                                    <x-tabler-edit class="w-4 h-4" />
                                </a>
                                <button class="btn btn-xs btn-square btn-error"
                                    wire:click="delete({{ $data->id }})">
                                    <x-tabler-trash class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @livewire('post.actions')
</div>
