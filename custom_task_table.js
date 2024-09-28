$(document).ready(function(){
    $('#data_table2').Tabledit({
        deleteButton: false,
        editButton: false,
        columns: {
            identifier: [0, 'tache_id'],
            editable: [ [2, 'titre_tache'],[3, 'status'], [4, 'date_debut'], [5, 'date_fin'], [6, 'projet_id'], [7, 'employee_id']]
        },
        hideIdentifier: true,
        url: 'task_edit.php'
    });
});