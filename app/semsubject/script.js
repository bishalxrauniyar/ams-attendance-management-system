
  function addSubject(semester_id) {
    // Redirect to the add_subject.php page
    window.location.href = 'add_subject.php?semester_id=' + semester_id;
}

function addSemSubject(semester_id, subject_id) {
  window.location.href = 'add_subject_request.php?semester_id=' + semester_id + '&subject_id=' + subject_id ;
}

