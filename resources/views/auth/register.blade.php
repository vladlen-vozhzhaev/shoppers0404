@extends('template')
@section('content')
    <div class="site-section site-section-sm site-blocks-1">
        <div class="container">
            <div class="col-sm-8 mx-auto">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Имя" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="lastname" placeholder="Фамилия" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Пароль" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Подтверждение пароля" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="form-control btn btn-primary" value="Зарегистрироваться">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
