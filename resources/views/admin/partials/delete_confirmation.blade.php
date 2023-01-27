<div class="overlay d-none">
    <form class="delete_confirmation" action="{{ route('admin.posts.destroy', ['post' => $post]) }}" method="POST">
        @method('DELETE')
        @csrf
        <h2>Are you sure?</h2>
        <button type="button" class="btn btn-warning btn_close">NO</button>
        <button class="btn btn-danger btn_delete">YES</button>
    </form>
</div>
