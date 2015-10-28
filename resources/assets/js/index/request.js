var Request = function(){
	this.ajax = function(url, method, datas, callback){
		$.ajax({
			headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        	'Accept': "application/game.play"
	    	},
			type: method,
			timeout: 3000,
			url : url,
			data: datas,
			dataType: "json",

			// 成功后执行
			success: function(data, textStatus){
				// console.log(this.statusCode);
				// if (data.result) {
					callback(data);
				// }
			},
			// 服务器错误执行
			error: function (XMLHttpRequest) {
				// console.log('error', XMLHttpRequest);
			},
			// 请求前执行
			beforeSend: function(XMLHttpRequest){
				// console.log('error', XMLHttpRequest);
				 NProgress.start();
			},
			// 请求完成执行
			complete: function(){
				NProgress.done();
			},
			// 处理ajax返回状态码
			statusCode: {
				501: function() {
					// body...
				},
				403: function(){

				},
				404: function() {
			    	// alert('page not found');
				},
				500: function(){

				},
			}
		});
	};
	this.get = function(url, data, callback){
		this.ajax(url, 'GET', data, callback);
	};

	this.post = function(url, data, callback){
		this.ajax(url, 'POST', data, callback);
	};

	this.index = function(url, data, callback){
		this.ajax(url, 'GET', data, callback);
	};

	this.create = function(url, data, callback) {
		this.ajax(url + '/create', 'GET', data, callback);
	};

	this.store = function(url, id, data, callback) {
		this.ajax(url, 'GET', data, callback);
	};

	this.show = function(url, id, data, callback) {
		this.ajax(url + '/' + id, 'POST', data, callback);
	};

	this.edit = function(url, id, data, callback) {
		this.ajax(url + '/' + id + '/edit', 'GET', data, callback);
	};

	this.update = function(url, id, data, callback) {
		this.ajax(url + '/' + id, 'PUT', data, callback);
	};

	this.destroy = function(url, id, data, callback) {
		this.ajax(url + '/' + id, 'DELETE', data, callback);
	};
};

var res = new Request();