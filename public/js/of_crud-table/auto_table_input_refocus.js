import { row_cell_indexes, set_caret } from "../helpers.js"


function auto_table_input_refocus(table) {
    let enter_key_code = 13

    table.addEventListener('keydown', (event)=>{ if (event.which === enter_key_code) {

        if (document.activeElement.tagName === 'INPUT') {
            let [row_index, cell_index] = row_cell_indexes(document.activeElement)
            let table_width = table.dataset.viewFields.split(',').length

            if (row_index+1 <= table.rows.length-1) {
                row_index += 1
            } else if (cell_index+1 <= table_width-1) {
                row_index = 1
                cell_index +=1
            } else {
                return
            }

            let lower_input = table.rows[row_index].cells[cell_index].children[0]
            if (lower_input.tagName === 'INPUT') {lower_input.select()}
        }
    } })
}


auto_table_input_refocus(document.getElementsByClassName('crud-table')[0])
