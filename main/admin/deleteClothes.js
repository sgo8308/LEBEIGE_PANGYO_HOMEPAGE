function deleteClothes(clothesId,whereCome){
    conf = confirm('정말로 삭제하시겠습니까?')
    if(conf){
        document.write("<form action=\"../dataProcessing/deleteClothesDataProcessing.php\" id='frm' method='post'>" +
            "<input type=\"hidden\" value="+clothesId+" name='id'>" +
            "<input type=\"hidden\" value="+whereCome+" name='whereCome'>");
        document.getElementById('frm').submit();
        document.write("</form>")
    }
}