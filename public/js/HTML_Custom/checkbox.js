const template = document.createElement('template');
template.innerHTML = `
<style>
    .checkbox_container{
        display: flex;
        line-height: 17px;
    }
    #check_wrapper{
        width: 16px;
        height: 16px;
        border: 1px solid black;
        margin-left:5px;
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
        
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently
        supported by Chrome, Edge, Opera and Firefox */
    }
</style>


<div class="checkbox_container">
    <div id="check_wrapper"><p class="check">&#10004</p></div>
    <span class="label"> <slot /> </span>
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