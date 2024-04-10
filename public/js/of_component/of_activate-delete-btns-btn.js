function activate_delete_btns() {
    ;[...document.getElementsByClassName('delete-btn')].forEach((delete_btn)=>{
        let img = delete_btn.getElementsByTagName('img')[0]
        if (img.src === window.php_vars['img_delete_off']){ delete_btn.click() }
    })
}


window.activate_delete_btns = activate_delete_btns
