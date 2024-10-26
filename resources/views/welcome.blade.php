@extends('layouts.front')

@section('content')
    @php
        $carousels = helper::carsoul();
        $highlights = helper::highlights();
        $items = helper::items();
    @endphp

    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" style="height: 80vh;">
        <div class="carousel-inner h-100">
            @foreach ($carousels as $key => $carousel)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }} h-100">
                    <img class="w-100 h-100 carousel-img" src="{{ asset('storage/carousels/' . $carousel->image) }}"
                        alt="{{ $carousel->name }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-white">{{ $carousel->name }}</h5>
                        <p class="text-white">{{ $carousel->detail }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Highlights</h2>
        <div class="bg-gray py-4" style="background-color: #111010;">
            <div class="row justify-content-center">
                @foreach ($highlights as $highlight)
                    <div class="col-4 col-md-2 mb-4">
                        <div class="highlight text-center" data-toggle="modal"
                            data-target="#highlightModal-{{ $highlight->id }}">
                            @if ($highlight->highlightImages->isNotEmpty())
                                <img src="{{ Storage::url($highlight->main_image) }}"
                                    style="width:20vw; height:20vh; object-fit:cover;" class="highlight-img rounded-circle"
                                    alt="{{ $highlight->name }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="highlight-img img-fluid rounded-circle"
                                    alt="{{ $highlight->name }}">
                            @endif
                            <h5 style="color: gold;">{{ $highlight->name }}</h5>
                        </div>
                    </div>

                    <div class="modal fade" id="highlightModal-{{ $highlight->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="highlightModalLabel-{{ $highlight->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-black text-gold ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="highlightModalLabel-{{ $highlight->id }}">
                                        {{ $highlight->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6>Details:</h6>
                                    <p>{{ $highlight->detail }}</p>
                                    <div id="highlightCarousel-{{ $highlight->id }}" class="carousel slide"
                                        data-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($highlight->highlightImages as $key => $image)
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    <img src="{{ Storage::url($image->image) }}"
                                                        class="d-block highlight-carousel-img" alt="{{ $image->name }}">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h6 style="color: gold;">{{ $image->name }}</h6>
                                                        <p>{{ $image->detail }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#highlightCarousel-{{ $highlight->id }}"
                                            role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#highlightCarousel-{{ $highlight->id }}"
                                            role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Products</h2>
        <div class="row">
            @foreach ($items as $item)
                <div class="col-4 col-md-3 mb-4">
                    <div class="product-card position-relative">
                        <img src="{{ $item->main_image ? Storage::url('items/' . $item->main_image) : 'https://via.placeholder.com/150' }}"
                            width="100%" height="300vh" object-fit="cover" alt="{{ $item->title }}">

                        <div class="overlay">
                            <h5 class="product-title">{{ $item->title }}</h5>
                            <div class="icons">
                                <button class="btn btn-light add-to-cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                <button class="btn btn-light quick-view" data-toggle="modal"
                                    data-target="#quickViewModal-{{ $item->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick View Modal -->
                <div class="modal fade" id="quickViewModal-{{ $item->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="quickViewModalLabel-{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content bg-black text-gold">
                            <div class="modal-header">
                                <h5 class="modal-title" id="quickViewModalLabel-{{ $item->id }}">{{ $item->title }}
                                </h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body row ">
                                <div class="col-md-6 ">
                                    <img id="mainImage-{{ $item->id }}"
                                        src="{{ $item->main_image ? Storage::url('items/' . $item->main_image) : 'https://via.placeholder.com/150' }}"
                                        width="100%" height="300vh" object-fit="cover" alt="{{ $item->title }}">
                                    <div class="d-flex mt-2">
                                        @foreach ($item->itemImages as $image)
                                            <img src="{{ Storage::url('item_images/' . $image->image) }}"
                                                class="img-thumbnail mr-2 mb-2 border-color" width="50vw"
                                                height="50vh" alt="{{ $image->coloure }}"
                                                onclick="updateMainImage('{{ Storage::url('item_images/' . $image->image) }}', '{{ $item->id }}')">
                                        @endforeach
                                        <img src="{{ Storage::url('items/' . $item->main_image) }}"
                                            class="img-thumbnail mr-2 mb-2 border-color" width="50vw" height="50vh"
                                            alt="{{ $image->coloure }}"
                                            onclick="updateMainImage('{{ Storage::url('items/' . $item->main_image) }}', '{{ $item->id }}')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $item->description }}</p>
                                    <p><strong>Price:</strong> {{ $item->price ?? 'N/A' }}</p>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($item->itemImages as $image)
                                            <div class="text-center mr-3 mb-3">
                                                <!-- Display color indicator with onclick event -->
                                                <span class="color-indicator"
                                                    onclick="updateMainImage('{{ Storage::url('item_images/' . $image->image) }}', '{{ $item->id }}')"
                                                    style="background-color: {{ $image->coloure }}; width: 30px; height: 30px; display: inline-block; border-radius: 50%; border: 2px solid #fff; cursor: pointer;"></span>

                                            </div>
                                        @endforeach
                                        <span>Avaliable in: {{ implode(', ', json_decode($item->sizes)) }}</span>
                                    </div>
                                    <button class="btn btn-light mt-3">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- WhatsApp Icon -->
            <div class="whatsapp" onclick="toggleChatify()">
                <i class="fab fa-whatsapp"></i>
            </div>

            <!-- Chatify Message Box -->
            <div class="chatify-box" id="chatifyBox">
                <!-- This is an example structure for the Chatify box. Replace with your actual Chatify HTML content. -->
                <div class="chatify-header">
                    <h4>Chat with us!</h4>
                    <button onclick="toggleChatify()" class="close-btn">&times;</button>
                </div>
                <div class="chatify-content">
                    <!-- Chatify iframe or embedded content here -->
                    <iframe src="{{ route('chatify') }}" title="Chatify" class="chatify-iframe"></iframe>
                </div>
            </div>

        </div>
    </div>


    <footer class="text-center mt-5 py-4 bg-dark text-white">
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </footer>

    <style>
        body {
            background-color: black;
            color: goldenrod;
        }

        .carousel-item img {
            height: auto;
            /* Allow height to adjust based on content */
            object-fit: cover;
            width: 100%;
        }

        .highlight-img {
            width: 100%;
            /* Change to 100% for better responsiveness */
            max-width: 150px;
            /* Maintain max width */
            height: auto;
            /* Allow height to adjust based on aspect ratio */
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(15, 0, 0, 0.904);
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .highlight {
            padding: 10px;
            transition: transform 0.5s ease;
            cursor: pointer;
        }

        .highlight:hover {
            transform: scale(1.1);
        }

        .product {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .product:hover {
            transform: scale(1.05);
        }

        .carousel-item {
            height: 100vh;
        }

        .highlight-carousel-img {
            width: 100%;
            height: auto;
            /* Allow height to adjust for responsiveness */
            max-height: 400px;
            /* Set max height */
            object-fit: cover;
        }

        .bg-black {
            background-color: rgb(15, 15, 15) !important;
        }

        .text-gold {
            color: gold !important;
        }

        .modal-content {
            background-color: black;
            color: goldenrod;
            border-radius: 0.5rem;
            /* Rounded corners for modals */
            overflow: hidden;
            /* Ensure content does not overflow */
        }

        /* Modal Dimensions */
        .modal {
            max-width: 90vw;
            /* Maximum width of modal */
            margin: auto;
            /* Center modal */
        }

        /* Responsive Height for Modals */
        .modal-dialog {
            max-height: 80vh;
            /* Maximum height for modal dialog */
            overflow-y: auto;
            /* Enable scrolling if content exceeds height */
        }

        .product-card {
            position: relative;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .main-img {
            width: 100%;
            transition: opacity 0.3s ease;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateY(100%);
            transition: opacity 0.3s, transform 0.3s;
        }

        .product-card:hover .overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .product-title {
            color: gold;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .icons {
            display: flex;
            gap: 10px;
        }

        .add-to-cart,
        .quick-view {
            background: gold;
            color: black;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover,
        .quick-view:hover {
            background: darkgoldenrod;
        }

        /* Add border to thumbnail images */
        .border-color {
            border: 2px solid goldenrod;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .highlight-img {
                max-width: 100%;
                /* Full width on smaller screens */
            }

            .modal-content {
                height: auto;
                /* Allow height to adjust */
                max-height: 90vh;
                /* Adjust max height for mobile */
            }

            .modal {
                max-width: 90vw;
                /* Full width on mobile */
            }

            .modal-dialog {
                max-height: 80vh;
                /* Allow scrolling if content is too tall */
            }
        }

        @media (max-width: 576px) {
            .product-title {
                font-size: 1rem;
                /* Smaller font size for mobile */
            }

            .highlight {
                padding: 5px;
                /* Less padding on smaller screens */
            }
        }

        /* WhatsApp Icon */
        .whatsapp {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .whatsapp:hover {
            transform: scale(1.1);
        }

        /* Chatify Message Box */
        .chatify-box {
            display: none;
            /* Hidden by default */
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            height: 400px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            z-index: 1000;
            overflow: hidden;
        }

        .chatify-header {
            background-color: #25d366;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .chatify-content {
            width: 100%;
            height: calc(100% - 40px);
            /* Adjust based on header height */
        }

        .chatify-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>


    <script>
        function updateMainImage(imageSrc, itemId) {
            // Update the main image in the modal body
            const mainImageElement = document.getElementById(`mainImage-${itemId}`);
            mainImageElement.src = imageSrc; // Always update the main image source to the selected thumbnail
        }

        function toggleChatify() {
            const chatifyBox = document.getElementById('chatifyBox');
            chatifyBox.style.display = chatifyBox.style.display === 'none' || chatifyBox.style.display === '' ? 'block' :
                'none';
        }
    </script>
@endsection
