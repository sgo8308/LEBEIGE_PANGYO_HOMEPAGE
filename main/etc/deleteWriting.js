function deleteReview(reviewId){
    conf = confirm('정말로 삭제하시겠습니까?');
    if(conf){
        document.write("<form action=\"../dataProcessing/deleteReviewDataProcessing.php\" id='frm'>" +
            "<input type=\"hidden\" value="+reviewId+" name='id'>" +
            "</input>");
        document.getElementById('frm').submit();
        document.write("</form>")
    }
}

function deleteQuestion(postId){
    conf = confirm('정말로 삭제하시겠습니까?')
    if(conf){
        document.write("<form action=\"../dataProcessing/deleteQuestionDataProcessing.php\" id='frm'>" +
            "<input type=\"hidden\" value="+postId+" name='id'>" +
            "</input>");
        document.getElementById('frm').submit();
        document.write("</form>")
    }
}

function deleteAnswer(answerId,questionId){
    conf = confirm('정말로 삭제하시겠습니까?')
    if(conf){
        document.write("<form action=\"../dataProcessing/deleteAnswerDataProcessing.php\" id='frm' method='post'>" +
            "<input type=\"hidden\" value="+answerId+" name='id'></input>" +
            "<input type=\"hidden\" value="+questionId+" name='questionId'></input>");
        document.getElementById('frm').submit();
        document.write("</form>")
    }
}
