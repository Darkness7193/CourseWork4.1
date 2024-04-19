import { get_value, post, get_row_id_and_cl, set_by_double_keys, remove_elements_that_in_both, msleep} from "../helpers.js"




window.updated_rows = {}
window.new_rows = {}
window.deleted_rows = new Set([])
let view_fields = document.getElementsByClassName('crud-table')[0].dataset.viewFields.split(',')


function update_cell_of(editor) {
    let [row_id, cl] = get_row_id_and_cl(editor)
    let is_new_row = ()=>{ return (typeof(row_id) === "string" && row_id.slice(0, 7) === 'new_row') }

    if (is_new_row()) {
        set_by_double_keys(new_rows, [row_id, view_fields[cl]], get_value(editor))
    } else {
        set_by_double_keys(updated_rows, [row_id, view_fields[cl]], get_value(editor))
    }
}


function toggle_row_deleting(delete_btn) {
    let row_id = delete_btn.parentNode.parentNode.dataset.rowId
    let img = delete_btn.getElementsByTagName('img')[0]
    let is_add_to_delete = deleted_rows.has(row_id)

    if (is_add_to_delete) {
        deleted_rows.delete(row_id)
        img.src = window.php_vars['img_delete_off']
    } else {
        deleted_rows.add(row_id)
        img.src = window.php_vars['img_delete_on']
    }
}


function delete_empty_new_rows() {
    for (let [row_id, new_row] of Object.entries(new_rows)) {
        if (Object.values(new_row).join("") === "") { // if full of empty strings
            delete new_rows[row_id]
        }
    }
}


function submit_changes(controller, no_view_fields) {
    ;[deleted_rows, updated_rows] = remove_elements_that_in_both(deleted_rows, updated_rows)
    ;[deleted_rows, new_rows] = remove_elements_that_in_both(deleted_rows, new_rows)
    delete_empty_new_rows()

    post(window.php_vars['save_crud_route'], {
        'controller': controller,
        'updated_rows': updated_rows,
        'new_rows': new_rows,
        'no_view_fields': JSON.parse(no_view_fields),
        'deleted_rows': Array.from(deleted_rows)
    })

    location.reload();
}


window.update_cell_of = update_cell_of
window.toggle_row_deleting = toggle_row_deleting
window.submit_changes = submit_changes
