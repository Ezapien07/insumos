const inicializarGraficaOrdenesCompraInsumoPastel = (data) => {
    let valores = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        var tmp = {
            name: data[index].codigo,
            selected: (Number(index) === 1 ? true : false),
            y: parseInt(data[index].cantidad)
        };
        valores.push(tmp);
    }

    Highcharts.chart('containerOrdenesCompraInsumoPastel', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Cantidad de òrdenes de compras por insumos'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Cantidad',
            data: valores
        }]
    });
};

const inicializarGraficaOrdenesCompraInsumoBarra = (data)  => {

    let valores = [];
    let categoria = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        valores.push(Number(data[index].cantidad));
        categoria.push("<b>"+data[index].codigo+"</b>");
    }

    Highcharts.chart('containerOrdenesCompraInsumoBarra', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cantidad de òrdenes de compras por insumos'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: categoria,
            title: {
                text: null
            }
        },
        yAxis: {
            title: {
                text: '<b>Total</b>'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}"><b>{point.y}</b><br/>'
        },

        series: [
            {
                name: "Cantidad de òrdenes de compra",
                colorByPoint: true,
                data: valores
            }
        ]
    });

};

const inicializarGraficaCantidadSolicitadaInsumosPastel = (data) => {
    let valores = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        var tmp = {
            name: data[index].codigo,
            selected: (Number(index) === 1 ? true : false),
            y: parseInt(data[index].cantidad)
        };
        valores.push(tmp);
    }

    Highcharts.chart('containerCantidadSolicitadaInsumosPastel', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Cantidad de insumos solicitados por òrdenes de compra'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Cantidad',
            data: valores
        }]
    });
};

const inicializarGraficaCantidadSolicitadaInsumosBarra = (data)  => {

    let valores = [];
    let categoria = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        valores.push(Number(data[index].cantidad));
        categoria.push("<b>"+data[index].codigo+"</b>");
    }

    Highcharts.chart('containerCantidadSolicitadaInsumosBarra', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Cantidad de insumos solicitados por òrdenes de compra'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: categoria,
            title: {
                text: null
            }
        },
        yAxis: {
            title: {
                text: '<b>Total</b>'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}"><b>{point.y}</b><br/>'
        },

        series: [
            {
                name: "Cantidad de insumos solicitados",
                colorByPoint: true,
                data: valores
            }
        ]
    });

};

const inicializarGraficaTotalInsumosPastel = (data) => {
    let valores = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        var tmp = {
            name: data[index].codigo,
            selected: (Number(index) === 1 ? true : false),
            y: parseInt(data[index].cantidad)
        };
        valores.push(tmp);
    }

    Highcharts.chart('containerTotalInsumosPastel', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: '$ Total por insumos'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Cantidad',
            data: valores
        }]
    });
};

const inicializarGraficaTotalInsumosBarra = (data)  => {

    let valores = [];
    let categoria = [];
    let tamanio = data.length;

    for (let index = 0; index < tamanio; index++) {
        valores.push(Number(data[index].cantidad));
        categoria.push("<b>"+data[index].codigo+"</b>");
    }

    Highcharts.chart('containerTotalInsumosBarra', {
        exporting: {
            enabled: true
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '$ Total por insumos'
        },
        subtitle: {
            text: 'Sumatoria del gasto total por insumos'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: categoria,
            title: {
                text: null
            }
        },
        yAxis: {
            title: {
                text: '<b>Total</b>'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}"><b>{point.y}</b><br/>'
        },

        series: [
            {
                name: "Cantidad",
                colorByPoint: true,
                data: valores
            }
        ]
    });

};

const consultarReporteCompras = async () => {
    $.ajax({
        url: "/insumos/public/consultarComprasG",
        method: "GET",
        data: "",
    })
        .done(function (res) {
            inicializarGraficaOrdenesCompraInsumoPastel(res.insumos_compras);
            inicializarGraficaOrdenesCompraInsumoBarra(res.insumos_compras);
            inicializarGraficaCantidadSolicitadaInsumosPastel(res.insumos_solicitados);
            inicializarGraficaCantidadSolicitadaInsumosBarra(res.insumos_solicitados);
            inicializarGraficaTotalInsumosPastel(res.insumos_total);
            inicializarGraficaTotalInsumosBarra(res.insumos_total);
        })
        .fail(function (res) {
            console.log(res);
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "Ha ocurrido un error.",
                    confirmButtonText: "OK",
                },
                function () {
                    location.href = "/insumos/public/insumos";
                }
            );
        });
};

const convertirSVGaPNG = (svg, callback) => {
    const url = getSvgUrl(svg);
    constructor.svgUrlToPng(url, (imgData) => {
        callback(imgData);
        URL.revokeObjectURL(url);
    });
};

const getSvgUrl = (svg) => {
    return  URL.createObjectURL(new Blob([svg], {type: 'image/svg+xml'}));
};

const svgUrlToPng = (svgUrl, callback) => {
    const svgImage = document.createElement('img');

    svgImage.id = "imageExport";
    document.body.appendChild(svgImage);
    svgImage.onload = function () {
        const canvas = document.createElement('canvas');
        canvas.width = svgImage.clientWidth;
        canvas.height = svgImage.clientHeight;
        const canvasCtx = canvas.getContext('2d');
        canvasCtx.drawImage(svgImage, 0, 0);
        const imgData = canvas.toDataURL('image/png');
        callback(imgData);
        // document.body.removeChild(imgPreview);
    };
    svgImage.src = svgUrl;
};

$(document).ready(e => {
    consultarReporteCompras();
});