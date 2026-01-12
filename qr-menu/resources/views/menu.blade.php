<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Menü - Lezzet Durağı</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-md mx-auto bg-white min-h-screen shadow-2xl relative flex flex-col">
        <div class="h-40 bg-orange-600 flex flex-col items-center justify-center text-white p-6 shadow-inner">
            <h1 class="text-3xl font-extrabold tracking-tight uppercase">Lezzet Durağı</h1>
            <p class="text-xs opacity-80 uppercase tracking-widest mt-1">Dijital Menü</p>
        </div>

        <div class="px-4 -mt-6 z-20">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="searchInput" placeholder="Yemek veya içecek ara..." 
                    class="w-full pl-11 pr-4 py-4 bg-white rounded-2xl shadow-xl border-none focus:ring-2 focus:ring-orange-500 outline-none text-gray-700">
            </div>
        </div>

        <div class="p-4 flex-1">
            @forelse($categories as $category)
                <div class="category-section mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-orange-500 inline-block">
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
                                <div class="ml-4">
                                    <img src="https://loremflickr.com/150/150/food,{{ Str::slug($product->name) }}" 
                                         class="w-20 h-20 rounded-xl object-cover shadow-inner bg-gray-200">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20 text-gray-400">
                    <i class="fas fa-utensils text-5xl mb-4"></i>
                    <p>Menü şu an boş.</p>
                </div>
            @endforelse
        </div>

        <div class="p-8 bg-gray-50 border-t border-dashed flex flex-col items-center">
            <div class="bg-white p-4 rounded-2xl shadow-lg">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(request()->fullUrl()) }}" 
                     class="w-32 h-32" alt="QR">
            </div>
            <p class="text-[10px] text-gray-400 mt-3 font-bold uppercase tracking-widest">Masadan Taratın</p>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const products = document.querySelectorAll('.product-item');
            
            products.forEach(product => {
                const name = product.querySelector('.product-name').textContent.toLowerCase();
                if (name.includes(term)) {
                    product.style.display = 'flex';
                } else {
                    product.style.display = 'none';
                }
            });

            // Boş kalan kategorileri gizle
            document.querySelectorAll('.category-section').forEach(section => {
                const visibleProducts = section.querySelectorAll('.product-item[style="display: flex;"]').length;
                const totalProducts = section.querySelectorAll('.product-item').length;
                
                // Eğer arama kutusu boşsa her şeyi göster
                if (term === "") {
                    section.style.display = 'block';
                    section.querySelectorAll('.product-item').forEach(p => p.style.display = 'flex');
                } else if (visibleProducts === 0) {
                    section.style.display = 'none';
                } else {
                    section.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>