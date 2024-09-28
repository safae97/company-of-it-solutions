$(document).ready(function(){
    $('#data_table').Tabledit({
      deleteButton: false,
      editButton: false,
      columns: {
        identifier: [0, 'projet_id'], // Identifier remains project ID
        editable: [[3, 'status'], [4, 'date_debut'], [5, 'date_fin']] // Make project name (index 1) uneditable
      },
      hideIdentifier: true,
      url: 'live_edit.php'
    });
  });