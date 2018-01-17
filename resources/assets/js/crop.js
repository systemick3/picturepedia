jQuery(function($) {
  $('#jcrop_target').Jcrop({
    onChange: addCoords,
    onSelect: addCoords,
    onRelease: clearCoords,
    aspectRatio: 1
  });
});

function addCoords(c) {
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#x2').val(c.x2);
  $('#y2').val(c.y2);
  $('#w').val(c.w);
  $('#h').val(c.h);

  var rx = 100 / c.w;
  var ry = 100 / c.h;

  $('#preview').css({
    width: Math.round(rx * 600) + 'px',
    height: Math.round(ry * 600) + 'px',
    marginLeft: '-' + Math.round(rx * c.x) + 'px',
    marginTop: '-' + Math.round(ry * c.y) + 'px'
  });
}

function clearCoords(c)
{
  $('#x').val(0);
  $('#y').val(0);
  $('#x2').val(0);
  $('#y2').val(0);
  $('#w').val(0);
  $('#h').val(0);
}
