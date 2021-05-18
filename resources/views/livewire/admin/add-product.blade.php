<div>
    <form class="form-horizontal">        
      <div class="form-row">
        <!-- Text input-->
        <div class="form-group col-md-4">
          <label for="product_id">PRODUCT ID</label>
          <input type="text" class="form-control" id="product_id" placeholder="PRODUCT ID">
        </div>
        
        <!-- Text input-->
        <div class="form-group col-md-4">
          <label for="product_name">PRODUCT NAME</label>
          <input type="text" class="form-control" id="product_name" placeholder="PRODUCT NAME">
        </div>
        

        <!-- Text input-->
        <div class="form-group col-md-4">
          <label for="product_brand">BRAND</label>
          <input type="text" class="form-control" id="product_brand" placeholder="PRODUCT BRAND">
        </div>
        
        <!-- Select Basic -->
        <div class="form-group col-md-4">
          <label for="product_categorie">PRODUCT CATEGORY</label>
          <select id="product_categorie" name="product_categorie" class="form-control">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @foreach ($category->children as $childCategory)
                @include('admin.child_category', ['child_category' => $childCategory])
              @endforeach
            @endforeach
          </select>
        </div>

        <!-- Text input-->
        <div class="form-group col-md-4">
          <label for="product_price">PRODUCT PRICE</label>  
          <input id="product_price" name="product_price" placeholder="PRODUCT PRICE" class="form-control input-md" required="" type="text">
        </div>
        
        <!-- Text input-->
        <div class="form-group col-md-4">
          <label for="product_cost">PRODUCT COST (For annual report)</label>  
          <input id="product_cost" name="product_cost" placeholder="PRODUCT COST" class="form-control input-md" required="" type="text">
          <span>Don't worry! No one will see this.</span>
        </div>

        <!-- Text input-->
        <div class="form-group col-md-4">
          <label for="available_quantity">AVAILABLE QUANTITY</label>  
          <input id="available_quantity" name="available_quantity" placeholder="AVAILABLE QUANTITY" class="form-control input-md" required="" type="text">
        </div>
        
        <!-- Text input-->
        <div class="form-group col-md-4">
          <label for="percentage_discount">PERCENTAGE DISCOUNT</label>  
          <input id="percentage_discount" name="percentage_discount" placeholder="PERCENTAGE DISCOUNT" class="form-control input-md" required="" type="text">
        </div>

        <!-- Textarea -->
        <div class="form-group col-md-4">
          <label for="product_description">PRODUCT DESCRIPTION</label>        
          <textarea class="form-control" id="product_description" name="product_description"></textarea>
        </div>

        <!-- File Button --> 
        <div class="form-group col-md-4 mr-2">
          <input type="file" class="custom-file-input" id="main_image" required>
          <label class="form-control custom-file-label" for="main_image">main_image</label>
        </div>

        <!-- File Button --> 
        <div class="form-group col-md-4 mr-2">
          <input type="file" class="custom-file-input" id="auxiliary_images" multiple>
          <label class="form-control custom-file-label" for="auxiliary_images">auxiliary_images</label>
        </div>
        
        <!-- Button -->
        <div class="form-group col-md-3">
          <button class="btn btn-primary btn-block">Save</button>
        </div>
      </div>
    </form>
</div>
