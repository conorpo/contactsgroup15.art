// The array of contacts
let contacts = [jeremy = {firstName:"Jeremy", lastName:"Scott", age:29}];
// Counts the current top index value of contacts
let contactsTopIndex = 0;

// Create new contact
function AddNew() {
    // Open box to add a person
    ShowAddBox();
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
    // Take the index and create a string where it is removed

}

function ShowAddBox() {

}