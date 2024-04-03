import { row_cell_indexes, set_caret } from "../helpers.js"


function auto_table_input_refocus(table) {
    let enter_key_code = 13

    table.addEventListener('keydown', (event)=>{ if (event.which === enter_key_code) {

        if (document.activeElement.tagName === 'INPUT') {
            let [row_index, cell_index] = row_cell_indexes(document.activeElement)
            let has_next_row = ()=>{ return row_index+1 <= table.rows.length-1 }
            let has_next_col = ()=>{ return cell_index+1 <= table.dataset.viewFields.split(',').length-1 }

            if (has_next_row()) {
                row_index += 1
            } else if (has_next_col()) {
                cell_index +=1
                row_index = 1
            } else {
                return
            }

            let lower_input = table.rows[row_index].cells[cell_index].children[0]
            if (lower_input.tagName === 'INPUT') {lower_input.select()}
        }
    } })
}


auto_table_input_refocus(document.getElementsByClassName('crud-table')[0])
