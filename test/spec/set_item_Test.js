describe("set_item> ", function(){
	describe("select_person_cnt> ", function(){
		beforeEach(function(){
			spyOn(console, "log");
		    var data = {};
				var voteinfo = {"voter_name": "テスト", "voter_id": "test"};
				var str_voteinfo = JSON.stringify(voteinfo);

			$('body').append("<div id='voterid'></div>");
			$('body').append("<input type='hidden' name='checkvote' id='checkvote' value='0'>");
			$("#voterid").val(str_voteinfo);

		})

		it("non-dataInQRcode", function() {
			var selected_json = {
				contender1:"111",
				contender2:"222",
				contender3:"333"
			};
			localStorage.setItem('Candidate_ID', JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("data = null");
		});

		it("under_3", function(){
			var selected_json = {
				contender3:"333",
				contender5:"555"
			};
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count < 3");
		});
		it("greater_3", function(){
			var selected_json = {
				contender3:"333",
				contender4:"444",
				contender5:"555",
				contender1:"111"
			};
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count > 3");
		});
	});
});
