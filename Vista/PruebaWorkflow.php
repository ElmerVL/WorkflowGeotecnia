<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" />
<meta charset=utf-8 />
<title>Cytoscape.js initialisation</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://cytoscape.github.io/cytoscape.js/api/cytoscape.js-latest/cytoscape.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/jquery.qtip.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/jquery.qtip.min.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/jquery.qtip.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/cytoscape/cytoscape.js-qtip/70964f0306e770837dbe2b81197c12fdc7804e38/cytoscape-qtip.js"></script>
<script src="code.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body style="font: 12px helvetica neue, helvetica, arial, sans-serif;">
    <div id="cy" style="height: 100%;
                        width: 100%;
                        position: absolute;
                        left: 0;
                        top: 0;">
      
    </div>
</body>
</html>

<script>
$(function(){ // on dom ready

$('#cy').cytoscape({
  layout: {
    name: 'grid'
  },
  
  style: cytoscape.stylesheet()
    .selector('node')
      .css({
        'shape': 'data(faveShape)',
        'width': 'mapData(weight, 40, 80, 20, 60)',
        'content': 'data(name)',
        'text-valign': 'center',
        'text-outline-width': 1.5,
        'text-outline-color': 'data(faveColor)',
        'background-color': 'data(faveColor)',
        'color': '#fff',
        'font-size': '13px'
      })
    .selector(':selected')
      .css({
        'border-width': 1.5,
        'border-color': '#333'
      })
    .selector('edge')
      .css({
        'width': 'mapData(strength, 70, 100, 2, 6)',
        'target-arrow-shape': 'triangle',
        'source-arrow-shape': 'circle',
        'line-color': 'data(faveColor)',
        'source-arrow-color': 'data(faveColor)',
        'target-arrow-color': 'data(faveColor)'
      })
    .selector('edge.questionable')
      .css({
        'line-style': 'dotted',
        'target-arrow-shape': 'diamond'
      })
    .selector('.faded')
      .css({
        'opacity': 0.25,
        'text-opacity': 1
      }),
  
  elements: {
    nodes: [
      { data: { id: '1', name: '1 Nueva Solicitud', weight: 75, faveColor: '#86B342', faveShape: 'ellipse' } },
      { data: { id: '2', name: '2 Recibir Solicitud', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '3', name: '3 Asignar Supervisor', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '4', name: '4 Es trabajo de campo?', weight: 75, faveColor: '#6FB1FC', faveShape: 'hexagon' } },
      { data: { id: '5', name: '5 Elaborar alcance', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '6', name: '6 Revisar alcance', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '7', name: '7 Determinar costos', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '8', name: '8 Registrar muestra', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '9', name: '9 Determinar ensayos', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '10', name: '10 Estimar tiempos', weight: 75, faveColor: '#6FB1FC', faveShape: 'roundrectangle' } },
      { data: { id: '11', name: '11 Costo>10000?', weight: 75, faveColor: '#6FB1FC', faveShape: 'hexagon' } }
    ],
    
    edges: [
        { data: { source: '1', target: '2', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '2', target: '3', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '3', target: '4', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '4', target: '5', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '5', target: '6', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '6', target: '7', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '4', target: '8', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '8', target: '9', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '9', target: '10', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '10', target: '7', faveColor: '#EDA1ED', strength: 60 } },
        { data: { source: '7', target: '11', faveColor: '#EDA1ED', strength: 60 } }
    ]
  },
  
  ready: function(){
    window.cy = this;
    
  cy.$('#1').position({
    x: 80,
    y: 80
  });
  
  cy.$('#2').position({
    x: 230,
    y: 80
  });
  
  cy.$('#3').position({
    x: 360,
    y: 80
  });
  
  cy.$('#4').position({
    x: 500,
    y: 80
  });
  
  cy.$('#5').position({
    x: 640,
    y: 180
  });
  
  cy.$('#6').position({
    x: 780,
    y: 180
  });
  
  cy.$('#7').position({
    x: 910,
    y: 80
  });
  
  cy.$('#8').position({
    x: 570,
    y: 250
  });
  
  cy.$('#9').position({
    x: 710,
    y: 250
  });
  
  cy.$('#10').position({
    x: 850,
    y: 250
  });
  
  cy.$('#11').position({
    x: 1060,
    y: 80
  });

  
  cy.$('#1').qtip({
  content: 'Hello!',
  style: {
    classes: 'qtip-bootstrap',
    tip: {
      width: 16,
      height: 8
    }
  }
});
  
  
    // giddy up
  }
});

}); // on dom ready
</script>