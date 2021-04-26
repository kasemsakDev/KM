$(document).ready(function(){
	$.ajax({
		url: "AjaxManage/_report.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var player = [];
			var progressive = [];
            var id = [];
			for(var i in data) {
				player.push(data[i].Name+" ประเด็นยุทธศาสตร์ ทั้งหมด "+data[i].Count+" งาน");
				progressive.push(data[i].Progressive);
                id.push(data[i].Id);
			}

			var chartdata = {
				labels: player,
				datasets : [
					{
						label: 'Progressive',
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(5, 159, 64, 0.2)',
                            'rgba(125, 159, 64, 0.2)',
                            'rgba(88, 159, 64, 0.2)',
                        ],
						borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(5, 159, 64, 0.2)',
                            'rgba(125, 159, 64, 0.2)',
                            'rgba(88, 159, 64, 0.2)',
                        ],
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: progressive,
                        id : id
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
                options: {
                    'onClick' : function (evt, item) {
                        e = item[0];
                    //    alert(e._index);
                        var idagency = id[e._index];
                     //   alert(idagency);
                     
                      },
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 100
                            }
                        }]
                    }
                }
			});
		},
		error: function(data) {
			console.log(data);
		}
	});



    function onBarClicked($value) {
       alert($value);
      }
      

});