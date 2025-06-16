@extends('layout.layout')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-6">Chỉnh sửa hồ sơ</h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tên</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full mt-1 p-2 border rounded-md">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" class="w-full mt-1 p-2 border rounded-md">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Avatar</label>
                <input type="file" name="avatar" class="mt-1">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Lưu thay đổi
            </button>
        </form>
    </div>
@endsection
