$(() => {
    const refreshStars = (source) =>{
        $(".star").removeClass("starFill");
        var grade = $(source).prop('id').substring(5);
    
        $( ".star").slice(0, grade).addClass("starFill");
        return grade;
    }

    $(".star").mouseover(function(){
      refreshStars(this);
    })


    $(".star").click(function(){
        $("#recipeGrade").val(refreshStars(this));
    })


})


