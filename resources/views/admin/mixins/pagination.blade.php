<nav >
  <ul class="pagination">
    <li class="page-item">
      <button 
          class="page-link"
          button-pagination="1">
          Trang đầu
      </button>
    </li>
    
    @if($pagination['currentPage'] > 1)
      <li class="page-item">
        <button 
            class="page-link"
            button-pagination="{{ $pagination['currentPage']-1 }}">
            Trang trước
        </button>
      </li>
    @endif

    @for($i = 1; $i <= $pagination['totalPage']; $i++)
      <li class="page-item {{ $pagination['currentPage'] == $i ? 'active' : '' }}">
        <button 
          class="page-link" 
          button-pagination="{{ $i }}">
          {{ $i }}
        </button>
      </li>
    @endfor

    @if($pagination['currentPage'] < $pagination['totalPage'])
      <li class="page-item">
        <button 
          class="page-link"
          button-pagination="{{ $pagination['currentPage']+1 }}">
          Kế tiếp
        </button>
      </li>
    @endif

    <li class="page-item">
      <button 
        class="page-link"
        button-pagination="{{ $pagination['totalPage'] }}">
        Trang cuối
      </button>
    </li>
  </ul>
</nav>