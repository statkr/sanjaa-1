<div class="sidebar-container">

    <!-- Keywords -->
    <div class="sidebar-widget">
      <h3>Keywords</h3>
      <div class="keywords-container">
        <div class="keyword-input-container">
          <input type="text" class="keyword-input" placeholder="e.g. Wordpress"/>
          <button type="button" class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
        </div>
        <div class="keywords-list">
          <!-- keywords go here -->
        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  <form action="search.php" id="search-form"  method="get" data-animation="fadeInDown" data-timeout="200">

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
      <h3>Fixed Price</h3>
      <div class="margin-top-55"></div>

      <!-- Range Slider -->
      <input name="price" class="range-slider" type="text" value="" data-slider-currency="Fcfa " data-slider-min="1000" data-slider-max="500000" data-slider-step="500" data-slider-value="[1000,500000]"/>
    </div>

  <!-- Tags -->
  <div class="sidebar-widget">
    <h3>Top Skills</h3>

    <div class="tags-container">
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag1" />
        <label for="tag1">frontend development </label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag2"/>
        <label for="tag2">angular</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag3"/>
        <label for="tag3">react</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag4"/>
        <label for="tag4">vuejs</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag5"/>
        <label for="tag5">Android </label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag6"/>
        <label for="tag6">ios</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag7"/>
        <label for="tag7">wordpress</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag8"/>
        <label for="tag8">Photoshop</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag9"/>
        <label for="tag9">ecommerce</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag10"/>
        <label for="tag10">seo</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag11"/>
        <label for="tag11">adobe</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag12"/>
        <label for="tag12">java</label>
      </div>
      <div class="tag">
        <input class="skill_tag" type="checkbox" id="tag13"/>
        <label for="tag13">Net</label>
      </div>
    </div>


    <input type="hidden" id="skill_list" name="tags" value="">


    <div class="clearfix"></div>

  </div>
  <div class="clearfix"></div>


  <div class="sidebar-widget">
    <button type="button" style="width:100% ;" onclick="searcher()" class="button button-sliding-icon ripple-effect">Search <i class="icon-material-outline-arrow-right-alt"></i></button>
  </div>

  <div class="clearfix"></div>

  </form>

  </div>
