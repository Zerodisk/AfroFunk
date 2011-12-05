/*
 * tab switch function
 *   parameter
 *     - page: the selected page/tab to switch to (index of 1)
 */
function tabSwitch(page){
	myTab = $('#tab_search');
	
	//get the active page
	activePage = function(myTab){
		for (var i = 0; i <= myTab.children().length - 1;i++){
			if (myTab.children()[i].id == 'selected'){
				return i + 1;
			}
		}
	};
	activePage = activePage(myTab);
	
	if (activePage == page) {return;}	//click on the active page
	
	//de-selected old one
	myTab.children()[activePage - 1].id = '';
	//select new one
	myTab.children()[page-1].id = 'selected';
	
	//switch content below
	//
	//
	//
	
	
	
}
