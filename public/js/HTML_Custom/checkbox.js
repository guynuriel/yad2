const template = document.createElement('template');
template.innerHTML = `
<style>
    #check_wrapper{
        width: 16px;
        height: 16px;
        border: 1px solid black;
    }
    #check_wrapper:hover{
        border:1px solid #ff7100;
        cursor: pointer;
    }
    #check_wrapper > .check{
        color: white;
        margin: 0;
        text-align: center;
        line-height: 17px;
    }
</style>


<div>
    <div id="check_wrapper"><p class="check">&#10004</p></div>
</div>        

`;

class yad2CheckBox extends HTMLElement{
    constructor() {
        super();
        
        this.isChecked = false;

        this.attachShadow({mode: 'open'});
        this.shadowRoot.appendChild(template.content.cloneNode(true));

        if (this.getAttribute('checked') != null) {
            this.toggleCheck();
        }

    }

    toggleCheck() {
        
        
        this.isChecked = !this.isChecked;
        if (this.isChecked) {
            this.check();
        } else {
            this.uncheck();
        }         
    }

    check() {
        this.isChecked = true;
        const icon = this.shadowRoot.querySelector('.check');
        const check_div = this.shadowRoot.querySelector('#check_wrapper');

        icon.style.display = 'block';
        check_div.style.backgroundColor = '#ff7100';
        check_div.style.borderColor = '#ff7100';
    }

    uncheck() {
        this.isChecked = false;
        const icon = this.shadowRoot.querySelector('.check');
        const check_div = this.shadowRoot.querySelector('#check_wrapper');

        icon.style.display = 'none';
        check_div.style.borderColor = 'black';
        check_div.style.backgroundColor = '#fff';
    }
    connectedCallback() {
        this.shadowRoot.querySelector('#check_wrapper').
            addEventListener('click', () => this.toggleCheck());
    }

    disconnectedCallback() {
        this.shadowRoot.querySelector('#check_wrapper').
            removeEventListener();
    }
}




// window.customElements.define('tag-name',class-name);
window.customElements.define('custom-checkbox',yad2CheckBox);