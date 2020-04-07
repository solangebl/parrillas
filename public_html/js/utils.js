function loadProvincias(dom_selected_country, dom_to_load, default_opt){
	default_opt = default_opt || 'Seleccione una provincia';
    var country = dom_selected_country.val();

    $.ajax({
        url:  '/provinces/' + country,
        type: 'GET',
        dataType: 'json',
        success: function(res){
          dom_to_load.html('');
          var opt = $('<option>').val('').html(default_opt);
          dom_to_load.append(opt);
          res.provinces.forEach(function(e){
            var opt = $('<option>').val(e.id).html(e.name_es);
            dom_to_load.append(opt);
          })
        },
        error: function(){
            alert("Error al buscar las provincias");
        }  
      });
}

function loadAbstracts(dom_selected_country, dom_to_load, default_opt){
  default_opt = default_opt || 'Seleccione una ponencia';
  var ptype = dom_selected_country.val();

  $.ajax({
      url:  '/papers/' + ptype,
      type: 'GET',
      dataType: 'json',
      success: function(res){
        dom_to_load.html('');
        var opt = $('<option>').val('').html(default_opt);
        dom_to_load.append(opt);
        res.papers.forEach(function(e){
          var opt = $('<option>').val(e.id).html(e.id + ' - ' +e.title);
          dom_to_load.append(opt);
        })
      },
      error: function(){
          alert("Error al buscar las ponencias");
      }  
    });
}

function wordCount(element) {
	var text = $(element).val();
	text = text.replace(/(^\s*)|(\s*$)/gi,"");
	text = text.replace(/[ ]{2,}/gi," ");
	text = text.replace(/\n /,"\n");
	return text.split(' ').length;
}
