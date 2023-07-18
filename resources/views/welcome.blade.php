<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shoppingify</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=quicksand:500,700" rel="stylesheet" />
        {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet"> --}}
        <!-- Styles -->
        <script src="https://kit.fontawesome.com/a9775d2cf6.js" crossorigin="anonymous" defer></script>
        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="font-quicksand">
        <aside id="default-sidebar" class="fixed top-0 left-0 z-20 w-24 h-screen " aria-label="Sidebar">
            <div class="flex flex-col justify-between h-full px-3 py-4 overflow-y-auto bg-white">
                <div class="w-12 h-12  ">
                    <img class="object-cover w-full h-full" src="{{ asset('img/logo.svg') }}" alt="logo">
                </div>
                <ul class="flex flex-col items-center gap-10 font-normal">
                    <li class="flex items-center p-3 text-black rounded-lg hover:bg-slate-50 group">
                        <button id="vistaPrincipal" href="#">
                            <i class="fa-solid fa-list-ul fa-xl"></i>
                        </button>
                    </li>
                    <li class="flex items-center p-3 text-black rounded-lg hover:bg-slate-50 group">
                        <button id="vistaListas" href="#">
                            <i class="fa-solid fa-clock-rotate-left fa-xl"></i>
                        </button>
                    </li>
                    <li class="flex items-center p-3 text-black rounded-lg hover:bg-slate-50 group">
                        <button id="vistaGraficas" href="#">
                            <i class="fa-solid fa-chart-line fa-xl"></i>
                        </button>
                    </li>
                </ul>
                <div class="flex place-self-center static">
                    <div class=" rounded-full bg-amber-400 text-center w-10 h-10 pt-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <span id="carro" class="bg-red-500 w-5 h-5 rounded align-middle text-center absolute bottom-10 left-14 text-white">0</span>
                </div>
            </div>
        </aside>
        <div class="p-20 ml-24 bg-slate-50 mr-96  pt-9">
            <div id="principal" class="">
                <div class="flex flex-row justify-between mb-10">
                    <h1 class="text-2xl"><span class=" text-amber-500 font-bold">Shoppingify</span> allows you take your
                    shopping list wherever you go</h1>
                    <form>
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search"
                            class="block w-48 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500    "
                            placeholder="Search" required>
                        </div>
                    </form>
                </div>
                @foreach ($categories as $category)
                    <div class="mb-10 mt-10 ">
                        <h3 class="mb-5 text-xl">{{ $category->name }}</h3>
                        <div id="contenido{{ $category->id }}" class="grid grid-cols-4 gap-10">
                        </div>
                    </div>
                @endforeach
                <!-- Modal -->
                <div id="myModal" class="fixed inset-0 flex items-center justify-end z-50 hidden">
                    <div class="bg-white w-96 h-screen overflow-y-auto p-6">
                        <h2 class="text-xl font-bold mb-4">Add a new item</h2>
                        <form action="{{ route('items.store') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input name="name" type="text" id="default-input"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                            </div>
                            <div class="mb-6">
                                <label for="default-input"
                                class="block mb-2 text-sm font-medium text-gray-900">Note(opcional)</label>
                                <input type="text" id="default-inpu" name="note"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                            </div>
                            <div class="mb-6">
                                <label for="default-input"
                                class="block mb-2 text-sm font-medium text-gray-900">image(opcional)</label>
                                <input type="text" id="default-image" name="image"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                            </div>
                            <div class="mb-6">
                                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900">Selecciona una
                                categoria</label>
                                <select id="categories" name="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button id="closeModal"
                                class="mt-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" id="closeModal1"
                                class="mt-4 bg-sky-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="listas" class="hidden">
                <h1>Shopping History</h1>
                <div>
                    <p class="mb-4">July</p>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($listnames as $listname)
                            <div class=" bg-white h-14 drop-shadow-md rounded-lg flex items-center justify-between  px-4">
                                <p>{{$listname->name}}</p>
                                <span><i class="fa-solid fa-calendar-days"></i> {{$listname->date}} </span>
                            </div>
                            
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="graficas" class="hidden">
                <div class="grid grid-cols-2 gap-10">
                    <div>
                        <h1 class="text-center mb-2">top items</h1>
                        <div class="mb-1 text-base font-medium text-black flex justify-between ">
                            <p>Banana</p>
                            <span>45%</span>
                        </div>
                            <div class="mb-4 w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 45%"></div>
                        </div>
                        <div class="mb-1 text-base font-medium text-black flex justify-between ">
                            <p>Apple</p>
                            <span>20%</span>
                        </div>
                            <div class=" mb-4 w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 20%"></div>
                        </div>
                        <div class="mb-1 text-base font-medium text-black flex justify-between ">
                            <p>Chilli pepper</p>
                            <span>18%</span>
                        </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 18%"></div>
                        </div>
                        
                        
                    </div>
                    <div> <h1 class="text-center mb-2">top Categories</h1>
                        <div class="mb-1 text-base font-medium text-black flex justify-between ">
                            <p>Fruit and vegetables</p>
                            <span>45%</span>
                        </div>
                            <div class="mb-4 w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-sky-500 h-2.5 rounded-full" style="width: 45%"></div>
                        </div>
                        <div class="mb-1 text-base font-medium text-black flex justify-between ">
                            <p>Meat and Fish</p>
                            <span>20%</span>
                        </div>
                            <div class=" mb-4 w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-sky-500 h-2.5 rounded-full" style="width: 20%"></div>
                        </div>
                        <div class="mb-1 text-base font-medium text-black flex justify-between ">
                            <p>Beverages</p>
                            <span>18%</span>
                        </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-sky-500 h-2.5 rounded-full" style="width: 18%"></div>
                        </div></div>
                    <div class=" col-span-2">Montly summary</div>
                </div>
            </div>
            
        </div>
        <aside id="default-sidebar" class="fixed top-0 right-0 z-20 w-96 h-screen bg-red-100 " aria-label="Sidebar">
            <div class="flex flex-col gap-2 h-full px-9 py-4 overflow-y-auto ">
                <div class="flex flex-row gap-8 h-32 bg-pink-900 rounded-lg">
                    <div class="w-15 h-18">
                        <img class="object-cover w-full h-full" src="{{ asset('img/source.svg') }}" alt="logo">
                    </div>
                    <div class="pt-4 ">
                        <p class="text-white">Didn’t find what you <br> need?</p>
                        <button id="openModal" class=" mt-1 bg-white rounded-lg p-2 px-6">Add item</button>
                    </div>
                </div>
                <div class="mt-12 h-80 w-full overflow-y-auto">
                    <h2 class="font-bold text-2xl text-gray-950 mb-3">Shoping List</h2>
                    <div id="Shoping">
                        <!-- Aqui se genera el carrito de compras -->
                    </div>
                </div>
                <div class="pt-8">
                    <form id="formList" action="{{route('history.store')}}" method="POST">
                        @csrf
                        <div class="flex">
                            <div class="relative w-full">
                                
                                <input type="text" name="nombre" id="nombreLista"
                                    class="block p-2.5 w-full h-16 z-20 text-sm  rounded-lg border-amber-500 border-2"
                                    placeholder="Enter a name" required>
                                <button type="submit"
                                    class="absolute top-0 right-0 p-2.5 h-full text-sm font-medium text-white bg-amber-500 rounded-lg hover:bg-amber-400 ">
                                    Save
                                </button>
                            </div>
                            <input type="hidden" name="arreglo" id="arregloInput">
                        </div>
                    </form>
                </div>
            </div>
        </aside>
        <script>
            datos2 = @json($items);
            
            let contenedor = document.getElementById("contenido1");
            let contenedor1 = document.getElementById("contenido2");
            let contenedor2 = document.getElementById("contenido3");
            for (var i = 0; i < datos2.length; i++) {
                let div = document.createElement('div');
                let dato = datos2[i].name;
                let id = datos2[i].id;
                div.className = "bg-white items-center drop-shadow-md rounded-lg py-2 px-4 flex flex-row justify-between";
                div.innerHTML =`${dato}<button id="${id}" class="agregarFruta" data-valor="${dato}"><i class="fa-solid fa-plus"></i></button></div>`;
                if (datos2[i].category_id == 1) {
                    contenedor.appendChild(div)
                } else if (datos2[i].category_id == 2) {
                    contenedor1.appendChild(div)
                } else {
                    contenedor2.appendChild(div)
                }
            }
            //se genera funcion para botones de la ShoppingList
            let contenedorLista = document.getElementById("Shoping");
            let arregloContenedor = Array.from(contenedor.children);
            let arregloContenedor1 = Array.from(contenedor1.children);
            let arregloContenedor2 = Array.from(contenedor2.children);
            let lista = [];
            let carrito = document.querySelector('#carro');
            //se recorren los elementos para agregarles la funcion click
            arregloContenedor.forEach(element => {
                let boton = [...element.children]
                boton[0].addEventListener("click", function() {
                    let valor = boton[0].dataset.valor;
                    let valorid=boton[0].id
                    console.log(valorid)
                    // Agregar el valor al arreglo verificando si existe y sumando en cantidad si ya esta
                    const frutaExistente = lista.find(list => list.nombre == valor)
                    if (frutaExistente) {
                        frutaExistente.cantidad += 1
                    } else {
                        lista.push({
                            nombre: valor,
                            cantidad: 1,
                            idProducto : valorid
                        });
                        carrito.innerHTML = lista.length;
                    }
                    //imprimir valores en lista
                    contenedorLista.innerHTML = "";
                    lista.forEach(list => {
                    let div = document.createElement('div');
                    div.className = "flex w-72 h-8 mx-auto mb-5 justify-between";
                    div.innerHTML = `<p class=" text-lg">${list.nombre}</p>
                    <div class="relative">
                    <button class="border-2 h-8 flex justify-center items-center  rounded-full border-amber-500  text-amber-500 font-bold py-2 px-4 rounded">
                    <p class="">${list.cantidad} pcs</p>
                    </button>
                    <div class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden">
                    <ul class="py-2">
                    <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 1</a></li>
                    <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 2</a></li>
                    <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 3</a></li>
                    </ul>
                    </div>
                    </div>`
                    contenedorLista.appendChild(div)
                    const button = document.querySelector('.relative button');
                    const menu = document.querySelector('.relative .absolute');

                    button.addEventListener('click', function() {
                        menu.classList.toggle('hidden');


                        // Generar una lista HTML y mostrarla dentro del div ShoppingList


                    });
                });
                });
            });
            arregloContenedor1.forEach(element => {
                let boton = [...element.children]
                boton[0].addEventListener("click", function() {
                    let valor = boton[0].dataset.valor;
                    let valorid=boton[0].id
                    console.log(valorid)
                    // Agregar el valor al arreglo verificando si existe y sumando en cantidad si ya esta
                    const frutaExistente = lista.find(list => list.nombre == valor)
                    if (frutaExistente) {
                        frutaExistente.cantidad += 1
                    } else {
                        lista.push({
                        nombre: valor,
                        cantidad: 1,
                        idProducto : valorid
                        });
                        carrito.innerHTML = lista.length;
                    }
                    //imprimir valores en lista
                    contenedorLista.innerHTML = "";
                    lista.forEach(list => {
                        let div = document.createElement('div');
                        div.className = "flex w-72 h-8 mx-auto mb-5 justify-between";
                        div.innerHTML = `<p class=" text-lg">${list.nombre}</p>
                        <div class="relative">
                        <button class="border-2 h-8 flex justify-center items-center  rounded-full border-amber-500  text-amber-500 font-bold py-2 px-4 rounded">
                        <p class="">${list.cantidad} pcs</p>
                        </button>
                        <div class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden">
                        <ul class="py-2">
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 1</a></li>
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 2</a></li>
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 3</a></li>
                        </ul>
                        </div>
                        </div>`
                        contenedorLista.appendChild(div)
                        const button = document.querySelector('.relative button');
                        const menu = document.querySelector('.relative .absolute');
                        button.addEventListener('click', function() {
                            menu.classList.toggle('hidden');
                            // Generar una lista HTML y mostrarla dentro del div ShoppingList
                        });
                    });
                });
            });   
            arregloContenedor2.forEach(element => {
                let boton = [...element.children]
                boton[0].addEventListener("click", function() {
                    let valor = boton[0].dataset.valor;
                    let valorid=boton[0].id
                    console.log(valorid)
                    // Agregar el valor al arreglo verificando si existe y sumando en cantidad si ya esta
                    const frutaExistente = lista.find(list => list.nombre == valor)
                    if (frutaExistente) {
                        frutaExistente.cantidad += 1
                    } else {
                        lista.push({
                            nombre: valor,
                            cantidad: 1,
                            idProducto : valorid
                        });
                        carrito.innerHTML = lista.length;
                    }
                    //imprimir valores en lista
                    contenedorLista.innerHTML = "";
                    lista.forEach(list => {
                        let div = document.createElement('div');
                        div.className = "flex w-72 h-8 mx-auto mb-5 justify-between";
                        div.innerHTML = `<p class=" text-lg">${list.nombre}</p>
                        <div class="relative">
                        <button class="border-2 h-8 flex justify-center items-center  rounded-full border-amber-500  text-amber-500 font-bold py-2 px-4 rounded">
                        <p class="">${list.cantidad} pcs</p>
                        </button>
                        <div class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden">
                        <ul class="py-2">
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 1</a></li>
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 2</a></li>
                        <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Opción 3</a></li>
                        </ul>
                        </div>
                        </div>`
                        contenedorLista.appendChild(div)
                        const button = document.querySelector('.relative button');
                        const menu = document.querySelector('.relative .absolute');
                        button.addEventListener('click', function() {
                            menu.classList.toggle('hidden');
                            // Generar una lista HTML y mostrarla dentro del div ShoppingList
                        });
                    });
                });
            });
            //javascript para modals
            document.getElementById('openModal').addEventListener('click', function() {
                document.getElementById('myModal').classList.remove('hidden');
            });

            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('myModal').classList.add('hidden');
            });
            document.getElementById('closeModal1').addEventListener('click', function() {
                document.getElementById('myModal').classList.add('hidden');
            });

            //javascript para mandar el arreglo al form
            document.querySelector('#formList').addEventListener('click', function() {
                // Tu arreglo de JavaScript
                document.getElementById('arregloInput').value = JSON.stringify(lista);
                document.getElementById('nombreLista').value
            });
            //js para cambio de vistas
            let botonVistaP =document.querySelector('#vistaPrincipal');
            let botonVistaL =document.querySelector('#vistaListas');
            let botonVistaG =document.querySelector('#vistaGraficas');
            let vistaP =document.querySelector('#principal');
            let vistaL =document.querySelector('#listas');
            let vistaG =document.querySelector('#graficas');
            
            botonVistaP.addEventListener('click',function(){
                vistaP.className=''
                vistaL.className='hidden'
                vistaG.className='hidden'
            });
            botonVistaL.addEventListener('click',function(){
                vistaL.className=''
                vistaP.className='hidden'
                vistaG.className='hidden'
            });
            botonVistaG.addEventListener('click',function(){
                vistaG.className=''
                vistaL.className='hidden'
                vistaP.className='hidden'
            });
        </script>
    </body>
</html>
