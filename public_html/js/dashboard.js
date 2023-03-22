// Counts the current top index value of contacts
const parent = document.getElementById("ContactList");
// Create new contact
function AddNew(firstName, lastName, email, phone, id=-1) {
    // Get Elements by id of the form inputs
    const inputElement = document.getElementById("InputElement");

    // Take the data already entered and add a new box on the front-end
    firstName = firstName || document.getElementById("InputFirstNameContact").value;
    lastName = lastName || document.getElementById("InputLastNameContact").value;
    phone = phone || document.getElementById("InputPhoneNumberContact").value;
    email = email || document.getElementById("InputEmailContact").value;

    // Save those new details into a new contact box
    const newContact = document.getElementById("ContactTemplate").cloneNode(deep=true);

    newContact.classList.remove("invisible");
    newContact.children[0].value = firstName;
    newContact.children[1].value = lastName;
    newContact.children[2].value = email;
    newContact.children[3].value = phone;

    if(firstName.trim().length == 0) return alert("Contact must have a First Name");
    

    parent.insertBefore(newContact, inputElement);

    document.getElementById("InputFirstNameContact").value = ""; 
    document.getElementById("InputLastNameContact").value = ""; 
    document.getElementById("InputEmailContact").value = ""; 
    document.getElementById("InputPhoneNumberContact").value = ""; 

    if(id == -1) {
        console.log("adding");
        const url = "/api/add_contact.php";

        fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({firstName, lastName, email, phone, userId})
        })
        .then(res => res.json())
        .then(res => {
            if(res.value == 0){
                return alert(res.error);
            }
            newContact.children[4].addEventListener("click", (evt) => {
                //Save Function
                SaveContact(newContact, res.data);
            })
            newContact.children[5].addEventListener("click", (evt) => {
                //Delete Function
                DeleteContact(newContact, res.data);
            })
        });

    }else{
        newContact.children[4].addEventListener("click", (evt) => {
            //Save Function
            SaveContact(newContact, id);
        })
        newContact.children[5].addEventListener("click", (evt) => {
            //Delete Function
            DeleteContact(newContact, id);
        })
    }
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

function SaveContact(contactElement, contactId) {
    const url = "/api/update_contact.php";

    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            firstName: contactElement.children[0].value || "",
            lastName: contactElement.children[1].value || "",
            email: contactElement.children[2].value || "",
            phone: contactElement.children[3].value || "",
            userId,
            contactId
        })
    })
    .then(res => res.json())
    .then(res => {
        if(res.value == 0){
            return alert(res.error);
        }
    });
}

// Delete current contact info
function DeleteContact(contactElement, contactId) {
    const url = "api/delete_contact.php";

    fetch(url, {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        userId,
        contactId
    })
    }).then(res => res.json())
    .then(res => {
        if(res.value == 0){
            return alert(res.error);
        }
        
        contactElement.remove()
    });

}


function ClearSearch(){
	document.getElementById("firstNameSearch").value = "";
	document.getElementById("lastNameSearch").value = "";
	document.getElementById("phoneSearch").value = "";
	document.getElementById("emailSearch").value = "";
}


function SearchContacts(){
//Get All Values from search queries, temp for now
    const url = "/api/read_contact.php";

    while(parent.children.length > 1){
        parent.removeChild(parent.firstChild);
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            firstName: document.getElementById("firstNameSearch").value || "",
            lastName: document.getElementById("lastNameSearch").value|| "",
            phone: document.getElementById("phoneSearch").value || "",
            email: document.getElementById("emailSearch").value || "",
            userId
        })
    })
    .then(res => res.json())
    .then(res => {
        if(res.value == 0){
            return alert(res.error);
        }

        for(const contact of res.data){
            AddNew(contact.firstName, contact.lastName, contact.email, contact.phone, contact.contactId);
        }
    });
}
SearchContacts();