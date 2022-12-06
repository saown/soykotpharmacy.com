<div class="products mt-5 ms-5 me-5">
    <?php foreach ($productList as $product):?>
    <div class="product">
        <div class="p-id d-none"><?= $product->id?></div>
        <div class="p-details">
            <div class="p-name-and-type d-flex align-items-end gap-2">
                <p class="m-0 h4 p-name text-truncate" style="width: 250px"><?= $product->brand_name?></p>
            </div>
            <div class="mt-2 d-flex flex-column">
                <p class="m-0 power"><?= $product->brand_weight?></p>
                <p class="m-0 generic-name text-truncate" style="width: 250px;" title="<?= $product->brand_generic_name?>"><?= $product->brand_generic_name?></p>
                <p class="m-0 company-name text-truncate" style="width: 250px;" title="<?= $product->brand_company_name?>"><?= $product->brand_company_name?></p>
                <p class="m-0 note">Up down market rate negotiable.</p>
                <select class="mt-1 p-price" name="price" id="price">
                    <option value="<?= $product->price_type0 . " : " . $product->price0?>" class="<?= ($product->price0 == 0.00)? 'd-none' : ''?>"><?= $product->price_type0 .' : '.$product->price0.' tk'?></option>
                    <option value="<?= $product->price_type1 . " : " . $product->price1?>" class="<?= ($product->price1 == 0.00)? 'd-none' : ''?>"><?= $product->price_type1 .' : '.$product->price1.' tk'?></option>
                    <option value="<?= $product->price_type2 . " : " . $product->price2?>" class="<?= ($product->price2 == 0.00)? 'd-none' : ''?>"><?= $product->price_type2 .' : '.$product->price2.' tk'?></option>
                    <option value="<?= $product->price_type3 . " : " . $product->price3?>" class="<?= ($product->price3 == 0.00)? 'd-none' : ''?>"><?= $product->price_type3 .' : '.$product->price3.' tk'?></option>
                    <option value="<?= $product->price_type4 . " : " . $product->price4?>" class="<?= ($product->price4 == 0.00)? 'd-none' : ''?>"><?= $product->price_type4 .' : '.$product->price4.' tk'?></option>
                    <option value="<?= $product->price_type5 . " : " . $product->price5?>" class="<?= ($product->price5 == 0.00)? 'd-none' : ''?>"><?= $product->price_type5 .' : '.$product->price5.' tk'?></option>
                    <option value="<?= $product->price_type6 . " : " . $product->price6?>" class="<?= ($product->price6 == 0.00)? 'd-none' : ''?>"><?= $product->price_type6 .' : '.$product->price6.' tk'?></option>
                    <option value="<?= $product->price_type7 . " : " . $product->price7?>" class="<?= ($product->price7 == 0.00)? 'd-none' : ''?>"><?= $product->price_type7 .' : '.$product->price7.' tk'?></option>
                    <option value="<?= $product->price_type8 . " : " . $product->price8?>" class="<?= ($product->price8 == 0.00)? 'd-none' : ''?>"><?= $product->price_type8 .' : '.$product->price8.' tk'?></option>
                    <option value="<?= $product->price_type9 . " : " . $product->price9?>" class="<?= ($product->price9 == 0.00)? 'd-none' : ''?>"><?= $product->price_type9 .' : '.$product->price9.' tk'?></option>
                    <option value="<?= $product->price_type10 . " : " . $product->price10?>" class="<?= ($product->price10 == 0.00)? 'd-none' : ''?>"><?= $product->price_type10 .' : '.$product->price10.' tk'?></option>
                    <option value="<?= $product->price_type11 . " : " . $product->price11?>" class="<?= ($product->price11 == 0.00)? 'd-none' : ''?>"><?= $product->price_type11 .' : '.$product->price11.' tk'?></option>
                </select>
                <input class="mt-2 quantity" type="number" name="quantity" id="qty" placeholder='Quantity...' min="1">
            </div>
        </div>
        <div class="p-action">
            <button type="button" class="view-btn mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </button>
            <button type="button" class="add-btn mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </button>
        </div>
    </div>
    <?php endforeach;?>
</div>