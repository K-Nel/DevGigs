<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/logo.png" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <title>DevGigs | Find Tech Jobs & Projects</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center">
            <a href="/"
                ><img class="w-24 p-5" src="{{asset('images/logo.png')}}" alt="" class="logo"
            /></a>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                
                <li>
                    <a href="/gigs/manage" class="hover:text-laravel"
                        ><i class="fa-solid fa-gear"></i>
                        Manage Gigs</a
                    >
                </li>
                <li>
                    <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button>
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                    </form>
                </li>
                @else
                <li>
                    <a href="/register" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-plus"></i> Register</a
                    >
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a
                    >
                </li> 
                @endauth
            </ul>
        </nav> 
        <main>
            {{$slot}}
        </main>
    <footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
>
    <p class="ml-2 text-center">Copyright &copy; 2022, All Rights reserved.<br>Created by NelDev</p>

    <a
        href="/gigs/create"
        class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
        >Post Job</a
    >
</footer>
<x-flash-message />
</body>
</html>