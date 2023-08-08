@extends('template')
@section('content')
    <div class="site-section site-section-sm site-blocks-1">
        <div class="container">
            <form method="post" action="/addProduct" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <input type="text" name="title" placeholder="Название товара" class="form-control">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <input type="number" name="cost" placeholder="Цена" class="form-control">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <textarea name="description" placeholder="Описание" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="mb-3">
                            <input type="file" name="img" class="form-control">
                        </div>

                        <input type="submit" value="Добавить товар" class="form-control btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
