
@component('components.head', ['title' => 'Sản phẩm'])
@endcomponent

<main class="max-w-[1360px] mx-auto px-16 my-10 mt-[137px]">
  {{-- Filter --}}
  <div class="bg-gray-300 flex items-center gap-4 my-8 p-4 relative">
    <span class="absolute -top-4 px-6 text-18 bg-gray-100 text-primary-700 rounded-md shadow-md"><i class="fa-solid fa-filter"></i></span>
    <div class="">
      <span class="mr-1 text-18 font-semibold uppercase">Giá:</span>
      <select name="filter" id="" class="px-2 py-1 rounded-sm cursor-pointer outline-none">
        <option  value="">Mặc định</option>
        <option ><a href="">Tăng dần</a></option>
        <option ><a href="">Giảm dần</a></option>
      </select>
    </div>
  </div>
  @if ($title_search)
      <h3 class="my-4 text-28 text-center">{{$title_search}}</h3>
  @endif

  {{-- List product --}}
  <div class="grid grid-cols-5 gap-6">
    @foreach ($products as $product)
        <x-card-product :product="$product"/>
    @endforeach
  </div>

  {{-- panigator --}}
  @if (count($products) > 0)
    <div class="flex justify-center items-center gap-2 my-4">
      @if ($products->currentPage() !== 1)
        <a href="{{ $products->previousPageUrl() }}" class="mx-2 px-4 transition-all duration-300 hover:-translate-x-2"><i class="fa-solid fa-chevron-left"></i></a>
      @endif
      @for ($i = 1; $i <= $products->lastPage(); $i++)
        @if ($i == $products->currentPage())
          <span class="bg-primary-500 text-white px-3.5 py-1.5 border rounded-full pointer-events-none">{{ $i }}</span>
        @else
        {{-- Nếu nhiều hơn 5 trang và nếu đang ở trang cuối thì chỉ hiện 4 trang gần cuối (lastPage - 4) nếu nhỏ hơn thì hiện ... --}}
          @if ($products->lastPage() >= 5 && $products->lastPage() - $products->currentPage() == 0 && $i <= $products->lastPage() - 4)
              <span>...</span>
          @else
            <a href="{{ $products->url($i) }}" class="px-3.5 py-1.5 border rounded-full transition-all duration-300 hover:bg-primary-500 hover:text-white">{{ $i }}</a>
            @endif
        @endif
      @endfor
      @if ($products->currentPage() !== $products->lastPage())
        <a href="{{ $products->nextPageUrl() }}" class="mx-2 px-4 transition-all duration-300 hover:translate-x-2"><i class="fa-solid fa-chevron-right"></i></a>
      @endif
    </div>
  @else
    <div class="min-h-[200px] flex justify-center items-center">
      <span class="">Không tìm thấy kết quả phù hợp.</span>
    </div>
  @endif
</main>

<x-footer :js-file="''" />
