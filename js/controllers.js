function Formularios($scope){
	
	$scope.formVisibility1=false;
	$scope.formVisibility2=false;
	$scope.ShowForm1=function(){
		
		$scope.formVisibility1=true;
		$scope.formVisibility2=false;
	}
	$scope.ShowForm2=function(){
		
		$scope.formVisibility2=true;
		$scope.formVisibility1=false;
	}
}