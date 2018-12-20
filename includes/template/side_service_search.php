<div class="sidebar-container">

    <!-- Keywords -->
    <div class="sidebar-widget">
      <h3>Keywords</h3>
      <div class="keywords-container">
        <div class="keyword-input-container">
          <input type="text" class="keyword-input" placeholder="e.g. Design"/>
          <button type="button" class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
        </div>
        <div class="keywords-list">
          <!-- keywords go here -->
        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  <form action="search_services.php" id="search-form"  method="get" data-animation="fadeInDown" data-timeout="200">

    <!-- inputs for keywords search -->
    <input id="keywords" type="hidden" name="searchterm" value="">


      <!-- Category -->
      <div class="sidebar-widget">
        <h3>Category</h3>
        <select name="selected_cats[]" class="selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" >
          <?php
          $query = DB::getInstance()->get("category", "*", ["ORDER" => "item_order ASC"]);
          if($query->count()) {
            $x = 1;
          foreach($query->results() as $row) {
           $q1 = DB::getInstance()->get("job", "*", ["AND"=>["catid" => $row->catid]]);
           //$count[] = $q1->count();
           ?>
           <option value="<?php echo $row->catid ; ?>"><?php echo $row->name ; ?></option>
           <?php
           $x++;

           }
          }
          ?>
        </select>
      </div>


    <!-- Budget -->
    <div class="sidebar-widget">
      <h3>Hourly Rate</h3>
      <div class="margin-top-55"></div>

      <!-- Range Slider -->
      <input name="price" class="range-slider" type="text" value="" data-slider-currency="Fcfa" data-slider-min="100" data-slider-max="20000" data-slider-step="50" data-slider-value="[100,20000]"/>
    </div>

  <div class="clearfix"></div>


  <div class="sidebar-widget">
    <button type="button" style="width:100% ;" onclick="searcher()" class="button button-sliding-icon ripple-effect">Search <i class="icon-material-outline-arrow-right-alt"></i></button>
  </div>

  <div class="clearfix"></div>

  </form>

  </div>
