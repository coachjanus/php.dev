
const template = document.createElement('template');

template.innerHTML = `
<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css');
@import url('/css/form.css');
@import url('/css/auth.css');
</style>
<dialog id="login">
    <a href="#!" title="Close" class="close fas fa-times"></a>
     
      <div class="card">
        <h2>Sign In</h2>
        <form class="form-container">
          <div class="input-group">
            <label class="form-label">Username or email address<span>*</span></label>
            <input type="text" placeholder="Username or Email" required class="form-control">
          </div>
          <div class="input-group">
            <label class="form-label">Password<span>*</span></label>
            <input type="password" placeholder="Password" required class="form-control">
          </div>
                
          <input type="submit" value="Sing In" />
                
          <p>
            <a href="">Forget Password?</a> | Not a member? - <a href="/register">Sign on</a>
          </p>
          
        </form>
      </div>
        
    </dialog>
 `;
export default class Login extends HTMLElement {

    constructor() {
        super();
        this.shadow = this.attachShadow({mode: 'open'});
        this.shadow.appendChild(template.content);
    }

    connectedCallback() {
        const login = this.shadow.querySelector('#login');
        login.addEventListener('click', function() {
            this.close();
        });
    }
}