// Counts the current top index value of contacts
let contactsTopIndex = 0;

// Create new contact
function AddNew(firstName, lastName, email, phone, id=99) {
    // Get Elements by id of the form inputs
    const parent = document.getElementById("ContactList");

    // Take the data already entered and add a new box on the front-end
    firstName = firstName || document.getElementById("InputFirstNameContact").value;
    lastName = lastName || document.getElementById("InputLastNameContact").value;
    phone = phone || document.getElementById("InputPhoneNumberContact").value;
    email = email || document.getElementById("InputEmailContact").value;

    // Save those new details into a new contact box
    const newContact = document.getElementById("ContactTemplate").cloneNode(deep=true);

    // newContact.id = id;

    newContact.classList.remove("invisible");
    newContact.children[0].value = firstName;
    newContact.children[1].value = lastName;
    newContact.children[2].value = email;
    newContact.children[3].value = phone;

    //Add Event Listeners
    newContact.children[4].children[0].addEventListener("click", (evt) => {
        //Save Function
    })
    newContact.children[4].children[1].addEventListener("click", (evt) => {
        //Delete Function
    })
    
    parent.appendChild(newContact);
    // Format should be in:
    // <li class="list-group-item flex-parent invisible" id="ContactTemplate">
    //   0  <input class="flex-child first-name"> 
    //   1  <input class="flex-child last-name">
    //   2  <input class="flex-child email">
    //   3  <input class="flex-child phone-number">
    //   4  <div class="flex-child buttons">
    //        0 <button>Save</button>
    //        1 <button>Delete</button>
    //     </div>
    // </li>
    
}


// Log out
function LogOut() {

}

// Edit current contact info
function EditContact(index) {
    // Show the text boxes for each value that is important to us
    document.getElementById("InputFirstNameContact1").style.display = "block";
    document.getElementById("InputLastNameContact1").style.display = "block";
    document.getElementById("InputEmailContact1").style.display = "block";
    document.getElementById("InputPhoneNumberContact1").style.display = "block";
    
    // Replace info in the html script with that
    document.getElementById("LabelFirstNameContact1").style.display = "none";
    document.getElementById("LabelLastNameContact1").style.display = "none";
    document.getElementById("LabelEmailContact1").style.display = "none";
    document.getElementById("LabelPhoneNumberContact1").style.display = "none";

    // Hide the edit button
    document.getElementById("EditContact1").style.display = "none";
    
    // Show the save button
    document.getElementById("SaveContact1").style.display = "block";

}

function SaveContact(index) {
    // Save the contact at the current index
    
    // Hide the save button
    // Show the edit button
}

// Delete current contact info
function DeleteContact(index) {
    // 
    // Remove the API stuff

}


function SearchContacts(){
    //Get All Values from search queries, temp for now
    
    contacts = [];
    
    for(const contact of contacts){
        AddNew(contact.firstName, contact.lastName, contact.email, contact.phone, contact.userId);
    }
}

function ShowAddBox() {

}