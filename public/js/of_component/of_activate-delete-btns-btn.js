function activate_delete_btns() {
    ;[...document.getElementsByClassName('delete-btn')].forEach((delete_btn)=>{
        let img = delete_btn.getElementsByTagName('img')[0]
        if (img.src === window.php_vars['img_delete_off']){ delete_btn.click() }
    })
}


function deactivate_delete_btns() {
    ;[...document.getElementsByClassName('delete-btn')].forEach((delete_btn)=>{
        let img = delete_btn.getElementsByTagName('img')[0]
        if (img.src === window.php_vars['img_delete_on']){ delete_btn.click() }
    })
}



function toggle_activate_delete_btns_btn() {
    let img = document.getElementsByClassName('activate-delete-btns-btn')[0].getElementsByTagName('img')[0]

    if (img.src === window.php_vars['trash_can_icon']) {
        activate_delete_btns()
        img.src = window.php_vars['un_trash_can_icon']
    } else {
        deactivate_delete_btns()
        img.src = window.php_vars['trash_can_icon']
    }
}


window.toggle_activate_delete_btns_btn = toggle_activate_delete_btns_btn
