@extends('template')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="/">Главная</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{$product->title}}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="/{{$product->img}}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{$product->title}}</h2>
                    <p class="mb-4">{{$product->description}}</p>
                    <p><strong class="text-primary h4">{{$product->cost}} руб.</strong></p>
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>

                    </div>
                    <p><a href="/addCart/{{$product->id}}/1" class="buy-now btn btn-sm btn-primary">Добавить в корзину</a></p>

                </div>
            </div>
        </div>
        <div class="container my-3">
            <h3 class="my-3">Отзывы</h3>
            <div class="col-sm-8 my-3">
                <form onsubmit="sendForm(this); return false;">
                    @csrf
                    <input type="hidden" name="productId" value="{{$product->id}}">
                    <div class="mb-3">
                        <textarea name="review" class="form-control" placeholder="Отзыв"></textarea>
                    </div>
                    <div class="mb-3">
                        Оценка
                        <select name="mark" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="form-control btn btn-primary" value="Добавить отзыв">
                    </div>
                </form>
            </div>
            <div id="reviewsBlock"></div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Finding perfect t-shirt</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/cloth_2.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Polo Shirt</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/cloth_3.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">T-Shirt Mockup</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="images/shoe_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Corater</a></h3>
                                    <p class="mb-0">Finding perfect products</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let reviewsBlock = document.getElementById('reviewsBlock');
        function getReviews(){
            reviewsBlock.innerHTML = "";
            fetch('/getReviews/{{$product->id}}')
                .then(response=>response.json())
                .then(result=>{
                    console.log(result);
                    for (let i = 0; i < result.length; i++) {
                        let reviewsHTML = `
                        <div>
                            <p><strong>Пользователь:</strong> ${result[i].userName} | ${result[i].created_at}</p>
                            <p><strong>Отзыв:</strong> ${result[i].review}</p>
                            <p><strong>Оценка:</strong> ${result[i].mark}</p>
                            <hr>
                        </div>
                    `;
                        reviewsBlock.innerHTML += reviewsHTML; // reviewsBlock = reviewsBlock + reviewsHTML
                    }
                });
        }
        getReviews();

        function sendForm(form){
            let formData = new FormData(form);
            document.getElementsByName('review')[0].value = "";
            document.getElementsByName('mark')[0].value = 1;
            fetch('/addReview', {
                method: "post",
                body: formData
            }).then(response=>response.json())
                .then(function(result){
                    console.log(result);
                    getReviews();
                });
        }
    </script>
@endsection
