function loadSubcats(dom_selected_country, dom_to_load, cats, default_opt ){
	default_opt = default_opt || 'Seleccione una subcategoría';
    var cat = parseInt(dom_selected_country.val());

    var selected = cats.filter(function(e) {
      return parseInt(e.id) === cat;
    })

    if (selected.length == 1) {
      dom_to_load.html('');
      selected = selected[0];
      console.log(selected);
      if(selected.hasOwnProperty('subcategories')) {
        dom_to_load.show();
        var opt = $('<option>').val('').html(default_opt);
        dom_to_load.append(opt);
        selected.subcategories.forEach(function(e){
          var opt = $('<option>').val(e.id).html(e.name);
          dom_to_load.append(opt);
        });
      } else {
        dom_to_load.hide();
      }
    } else {
      alert('Error obteniendo subcategorías');
    }
}
