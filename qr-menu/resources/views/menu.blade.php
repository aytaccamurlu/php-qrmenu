<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Menü - Lezzet Durağı</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        html { scroll-behavior: smooth; }

        
        .category-section { scroll-margin-top: 280px; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-md mx-auto bg-white min-h-screen shadow-2xl relative flex flex-col">
        
        <div class="sticky top-0 z-50 bg-white shadow-lg">
            <div class="h-40 bg-orange-600 flex flex-col items-center justify-center text-white p-6">
                <h1 class="text-3xl font-extrabold tracking-tight uppercase">Lezzet Durağı</h1>
                <p class="text-xs opacity-80 uppercase tracking-widest mt-1">Dijital Menü</p>
            </div>

            <div class="px-4 -mt-6">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchInput" placeholder="Yemek veya içecek ara..." 
                        class="w-full pl-11 pr-4 py-4 bg-white rounded-2xl shadow-xl border border-gray-100 focus:ring-2 focus:ring-orange-500 outline-none text-gray-700">
                </div>
            </div>

            <div class="py-4 px-2 flex gap-2 overflow-x-auto no-scrollbar bg-white">
                @foreach($categories as $category)
                    <a href="#cat-{{ $category->id }}" 
                       class="px-4 py-2 rounded-full bg-gray-100 text-gray-800 whitespace-nowrap text-lg font-bold border border-gray-200 active:bg-orange-500 active:text-white transition-colors shadow-sm">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="p-4 flex-1">
            @forelse($categories as $category)
                <div id="cat-{{ $category->id }}" class="category-section mb-10">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-orange-500 inline-block uppercase">
                        {{ $category->name }}
                    </h2>
                    
                    <div class="grid gap-3">
                        @foreach($category->products as $product)
                            <div class="product-item flex items-center p-3 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm transition-all">
                                <div class="flex-1">
                                    <h3 class="product-name font-bold text-gray-900">{{ $product->name }}</h3>
                                    <p class="text-xs text-gray-500 leading-tight my-1">{{ $product->description }}</p>
                                    <span class="text-orange-600 font-black">{{ number_format($product->price, 2) }} TL</span>
                                </div>
                                <div class="ml-4 shrink-0">
                                    <img src="https://loremflickr.com/150/150/food,{{ Str::slug($product->name) }}" 
                                         class="w-20 h-20 rounded-xl object-cover shadow-sm bg-gray-200">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20 text-gray-400 font-bold">Menü Henüz Boş</div>
            @endforelse
        </div>

         <div class="p-10 bg-gray-50 border-t border-dashed flex flex-col items-center">
        <div class="bg-white p-6 rounded-3xl shadow-2xl mb-4 border border-gray-100">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode(request()->fullUrl()) }}" 
                 class="w-48 h-48" alt="QR">
        </div>
        <p class="text-xs text-gray-500 font-black uppercase tracking-[0.3em]">Menüyü Paylaş</p>
    </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            const products = document.querySelectorAll('.product-item');
            
            products.forEach(product => {
                const name = product.querySelector('.product-name').textContent.toLowerCase();
                product.style.display = name.includes(term) ? 'flex' : 'none';
            });

            document.querySelectorAll('.category-section').forEach(section => {
                const hasVisible = Array.from(section.querySelectorAll('.product-item')).some(p => p.style.display !== 'none');
                section.style.display = (hasVisible || term === "") ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
