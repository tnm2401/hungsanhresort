$(document).ready(function () {










    am4core.ready(function () {

        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        /**
         * Chart design taken from Samsung health app
         */

        var chart = am4core.create("thongkethunhap", am4charts.XYChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
        $.get( 'administrator/get-money-chart-data').then(function (response) {
            chart.data = response;

            chart.dateFormatter.inputDateFormat = "YYYY-MM-dd";
            chart.zoomOutButton.disabled = false;

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.strokeOpacity = 0;
            dateAxis.renderer.minGridDistance = 10;
            dateAxis.dateFormats.setKey("day", "d");
            dateAxis.tooltip.hiddenState.properties.opacity = 1;
            dateAxis.tooltip.hiddenState.properties.visible = true;


            dateAxis.tooltip.adapter.add("x", function (x, target) {
                return am4core.utils.spritePointToSvg({
                    x: chart.plotContainer.pixelX,
                    y: 0
                }, chart.plotContainer).x + chart.plotContainer.pixelWidth / 2;
            })

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inside = true;
            valueAxis.renderer.labels.template.fillOpacity = 0.3;
            valueAxis.renderer.grid.template.strokeOpacity = 0;
            valueAxis.min = 0;
            valueAxis.cursorTooltipEnabled = false;

            // // goal guides
            // var axisRange = valueAxis.axisRanges.create();
            // axisRange.value = 5000000;
            // axisRange.grid.strokeOpacity = 0.1;
            // axisRange.label.text = "Đạt chỉ tiêu";
            // axisRange.label.align = "right";
            // axisRange.label.verticalCenter = "bottom";
            // axisRange.label.fillOpacity = 0.8;

            // valueAxis.renderer.gridContainer.zIndex = 1;

            // var axisRange2 = valueAxis.axisRanges.create();
            // axisRange2.value = 8000000;
            // axisRange2.grid.strokeOpacity = 0.1;
            // axisRange2.label.text = "Vượt chỉ tiêu";
            // axisRange2.label.align = "right";
            // axisRange2.label.verticalCenter = "bottom";
            // axisRange2.label.fillOpacity = 0.8;

            var series = chart.series.push(new am4charts.ColumnSeries);
            series.dataFields.valueY = "steps";
            series.dataFields.dateX = "date";
            series.tooltipText = "{valueY.value}";
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.hiddenState.properties.opacity = 1;
            series.tooltip.hiddenState.properties.visible = true;
            series.tooltip.adapter.add("x", function (x, target) {
                return am4core.utils.spritePointToSvg({
                    x: chart.plotContainer.pixelX,
                    y: 0
                }, chart.plotContainer).x + chart.plotContainer.pixelWidth / 2;
            })

            var columnTemplate = series.columns.template;
            columnTemplate.width = 30;
            columnTemplate.column.cornerRadiusTopLeft = 20;
            columnTemplate.column.cornerRadiusTopRight = 20;
            columnTemplate.strokeOpacity = 0;

            columnTemplate.adapter.add("fill", function (fill, target) {
                var dataItem = target.dataItem;
                if (dataItem.valueY > 600000) {
                    return chart.colors.getIndex(0);
                } else {
                    return am4core.color("#a8b3b7");
                }
            })

            var cursor = new am4charts.XYCursor();
            cursor.behavior = "panX";
            chart.cursor = cursor;
            cursor.lineX.disabled = true;


            dateAxis.showOnInit = true;
            // // ...
            // chart.events.on("validated", function () {
            // dateAxis.zoomToDates(
            //     new Date(2020, 0),
            //     new Date(2020, 1),
            //     false,
            //     true // this makes zoom instant
            // );
            // });
            chart.addListener("rendered", function (event) {
                event.chart.dateAxis.zoomToDates(new Date(2020, 10, 21), new Date(2020, 1, 1), false, true, );
                dateAxis.start = 0;
                dateAxis.end = 1;
                dateAxis.keepSelection = true;
            });

            var middleLine = chart.plotContainer.createChild(am4core.Line);
            middleLine.strokeOpacity = 1;
            middleLine.stroke = am4core.color("#000000");
            middleLine.strokeDasharray = "2,2";
            middleLine.align = "center";
            middleLine.zIndex = 1;
            middleLine.adapter.add("y2", function (y2, target) {
                return target.parent.pixelHeight;
            })

            cursor.events.on("cursorpositionchanged", updateTooltip);
            dateAxis.events.on("datarangechanged", updateTooltip);

            function updateTooltip() {
                dateAxis.showTooltipAtPosition(0.5);
                series.showTooltipAtPosition(0.5, 0);
                series.tooltip.validate(); // otherwise will show other columns values for a second
            }


            var label = chart.plotContainer.createChild(am4core.Label);
            label.text = "Kéo biểu đồ để thay đổi ngày";
            label.x = 100;
            label.y = 50;
        })
        var ok = chart.exporting.menu = new am4core.ExportMenu();
        ok.x = 80;
        ok.y = 50;
    }); // end am4core.ready()






});
