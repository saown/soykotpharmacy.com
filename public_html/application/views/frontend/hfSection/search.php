<div class="search-bar" id="search-bar">
    <form method="post" action="<?= site_url('searchProducts') ?>" id="searchProducts">
        <input type="text" name="search" id="search" class="search" placeholder="Search..." autocomplete="off"/>
        <button type="submit">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.11115 15.2223C12.0385 15.2223 15.2223 12.0385 15.2223 8.11115C15.2223 4.18377 12.0385 1 8.11115 1C4.18377 1 1 4.18377 1 8.11115C1 12.0385 4.18377 15.2223 8.11115 15.2223Z"
                      stroke="#202C33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M17 17.0001L13.1333 13.1334" stroke="#202C33" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>
    </form>
    <div class="search-list card">
        <div class="card-body">

        </div>
    </div>
</div>