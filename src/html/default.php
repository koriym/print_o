<?php
return <<<EOT
<style>

    .link {
        fill: none;
        stroke: #666;
        stroke-width: 1.5px;
    }

    .link.object {
        stroke: red;
        stroke-width: 2.0px;
    }

    .link.array {
        stroke: #fdff95;
    }

    .link.scalar {
        stroke: gray;
        stroke-dasharray: 0,2 1;
    }

    circle {
        fill: #ccc;
        stroke: #333;
        stroke-width: 1.5px;
    }

    text {
        font: 10px sans-serif;
        pointer-events: none;
        text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
    }

</style>
<body></body>
<script src="http://koriym.github.io/print_o/d3/3.4.13/d3.min.js"></script>
<script>
    var list = {$list};
    var width = window.innerWidth, height = window.innerHeight;

    var force = d3.layout.force()
            .nodes(list.nodes)
            .links(list.links)
            .size([width, height])
            .linkDistance({$linkDistance})
            .charge({$charge})
            .on("tick", tick)
            .start();

    var svg = d3.select("body").append("svg")
            .attr("width", width)
            .attr("height", height);

    // Per-type markers, as they don't inherit styles.
    svg.append("defs").selectAll("marker")
            .data(["object", "scalar"])
            .enter().append("marker")
            .attr("id", function(d) { return d; })
            .attr("viewBox", "0 -5 10 10")
            .attr("refX", 15)
            .attr("refY", -1.5)
            .attr("markerWidth", 6)
            .attr("markerHeight", 6)
            .attr("orient", "auto")
            .append("path")
            .attr("d", "M0,-5L10,0L0,5");

    var path = svg.append("g").selectAll("path")
            .data(force.links())
            .enter().append("path")
            .attr("class", function(d) { return "link " + d.type; })
            .attr("marker-end", function(d) { return "url(#" + d.type + ")"; });

    var circle = svg.append("g").selectAll("circle")
            .data(force.nodes())
            .enter().append("circle")
            .attr("r", 7)
            .call(force.drag);

    var text = svg.append("g").selectAll("text")
            .data(force.nodes())
            .enter().append("text")
            .attr("x", 8)
            .attr("y", ".31em")
            .text(decorateName);

    // Use elliptical arc path segments to doubly-encode directionality.
    function tick() {
        path.attr("d", linkArc);
        circle.attr("transform", transform);
        text.attr("transform", transform);

    }

    function linkArc(d) {
        var dx = d.target.x - d.source.x,
                dy = d.target.y - d.source.y,
                dr = Math.sqrt(dx * dx + dy * dy);
        return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
    }

    function transform(d) {
        return "translate(" + d.x + "," + d.y + ")";
    }

    function decorateName(d) {
        if (typeof d.key !== "undefined") {
            return d.key + ' => ' + d.name;
        }
        if (typeof d.prop !== "undefined") {
            return '$' + d.prop + ' ' + d.name;
        }
        return d.name;
    }

    window.onresize = function() {
        width = window.innerWidth, height = window.innerHeight;
        svg.attr('width', width).attr('height', height);
        force.size([width, height]).resume();
    };

</script>
EOT;
