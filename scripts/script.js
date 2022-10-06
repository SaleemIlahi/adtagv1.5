var clients = [];
var campaigns = [];

/*
This function appends data to the table for admin (gati)
*/
function showRecordsForAdmin(arr) {
  document.getElementById("table").innerHTML = "";
  let table = "";
  table = `<table>
    <thead>
      <th style="text-align: center;">Date</th>
      <th style="text-align: center;">Client</th>
      <th style="text-align: center;">Campaign</th>
      <th style="text-align: center;">Previews</th>
      <th style="text-align: center;">Adtags</th>
      <th style="text-align: center;">Status</th>
    </thead>`;
  for (let i = 0; i < arr.length; i++) {
    table += `<tr>
      <td style="text-align: center;">${arr[i]["date"]
        .split("-")
        .reverse()
        .join("-")}</td>
      <td style="text-align: center;">${arr[i]["client"]}</td>
      <td style="font-weight: bold;">${arr[i]["campaign_name"]}</td>
      <td style="text-align: center;">
        <a target="_blank" href="./previews.php?id=${arr[i]["id"]}">url</a>
      </td>
      <td style="text-align: center;">
        <a target="_blank" href="./adtags.php?id=${arr[i]["id"]}">url</a>
      </td>
      <td style="text-align: center;">
        <input id="${arr[i]["id"]}" class="stat-input" type="text" value="${
      arr[i]["status"]
    }" />
    ${
      arr[i]["status_v"] === "staging"
        ? `<button value="${arr[i]["id"]}" class="stat-bttn" disabled>Disabled</button>`
        : `<button value="${arr[i]["id"]}" class="stat-bttn" onclick="updateStatus(this.value)">Change</button>`
    }
      </td>
    </tr>`;
  }
  table += `</table>`;
  document.getElementById("table").innerHTML = table;
}

/*
This function appends data to the table for others (HC)
*/
function showRecordsForHC(arr) {
  console.log(arr[0].status_v);
  document.getElementById("table").innerHTML = "";
  let table = "";
  table = `<table>
    <thead>
      <th style="text-align: center;">Date</th>
      <th style="text-align: center;">Client</th>
      <th style="text-align: center;">Campaign</th>
      <th style="text-align: center;">Previews</th>
      <th style="text-align: center;">Adtags</th>
      <th style="text-align: center;">Status</th>
      <th style="text-align: center;">Remark</th>
    </thead>`;
  for (let i = 0; i < arr.length; i++) {
    table += `<tr>
      <td style="text-align: center;">${arr[i]["date"]
        .split("-")
        .reverse()
        .join("-")}</td>
      <td style="text-align: center;">${arr[i]["client"]}</td>
      <td style="font-weight: bold;">${arr[i]["campaign_name"]}</td>
      <td style="text-align: center;">
        <a target="_blank" href="./previews.php?id=${arr[i]["id"]}">url</a>
      </td>
      <td style="text-align: center;">
        <a target="_blank" href="./adtags.php?id=${arr[i]["id"]}">url</a>
      </td>
      <td style="text-align: center;">${arr[i]["status"]}</td>
      <td style="display:flex;text-align: center; justify-content: space-evenly;">
        <textarea id="${arr[i]["id"]}">${arr[i]["remark"]}</textarea>
        ${
          arr[i]["status_v"] === "active"
            ? `<button disabled>Save</button>`
            : `<button onClick="updateRemark(${arr[i]["id"]})">Save</button>`
        }
        
      </td>
    </tr>`;
  }
  table += `</table>`;
  document.getElementById("table").innerHTML = table;
}

function showRecordsForVeena(arr) {
  console.log(arr);
  document.getElementById("table").innerHTML = "";
  let table = "";
  table = `<table>
  <thead>
  <th style="text-align: center;">Date</th>
  <th style="text-align: center;">Client</th>
  <th style="text-align: center;">Campaign</th>
  <th style="text-align: center;">Previews</th>
      <th style="text-align: center;">Adtags</th>
      <th style="text-align: center;">Status</th>
      <th style="text-align: center;">Remark</th>
    </thead>`;
  for (let i = 0; i < arr.length; i++) {
    table += `<tr>
      <td style="text-align: center;">${arr[i]["date"]
        .split("-")
        .reverse()
        .join("-")}</td>
        <td style="text-align: center;">${arr[i]["client"]}</td>
        <td style="font-weight: bold;">${arr[i]["campaign_name"]}</td>
        <td style="text-align: center;">
        <a target="_blank" href="./previews.php?id=${arr[i]["id"]}">url</a>
        </td>
      <td style="text-align: center;">
        <a target="_blank" href="./adtags.php?id=${arr[i]["id"]}">url</a>
        </td>
        <td style="text-align: center;">
        <select name="status_v" id="status_v">
        <option value="staging">staging</option>
        <option value="active">active</option>
        </select>
        </td>
        <td style="display:flex;text-align: center; justify-content: space-evenly;">
        <textarea id="${arr[i]["id"]}">${arr[i]["remark"]}</textarea>
        <button onClick="updateRemark(${arr[i]["id"]})">Save</button>
        </td>
        </tr>`;
  }

  table += `</table>`;
  document.getElementById("table").innerHTML = table;
  document.getElementById("status_v").value = arr[0].status_v;
}

/*
This function appends data to the table for the client
*/
function showRecordsForClient(arr) {
  document.getElementById("table").innerHTML = "";
  let table = "";
  table = `<table>
    <thead>
      <th style="text-align: center;">Date</th>
      <th style="text-align: center;">Client</th>
      <th style="text-align: center;">Campaign</th>
      <th style="text-align: center;">Previews</th>
      <th style="text-align: center;">Adtags</th>
      <th style="text-align: center;">Approval</th>
    </thead>`;
  for (let i = 0; i < arr.length; i++) {
    table += `<tr>
      <td style="text-align: center;">${arr[i]["date"]
        .split("-")
        .reverse()
        .join("-")}</td>
      <td style="text-align: center;">${arr[i]["client"]}</td>
      <td style="font-weight: bold;">${arr[i]["campaign_name"]}</td>
      <td style="text-align: center;">
        <a target="_blank" href="./previews.php?id=${arr[i]["id"]}">url</a>
      </td>
      <td style="text-align: center;">
        <a target="_blank" href="./adtags.php?id=${arr[i]["id"]}">url</a>
      </td>
      ${
        arr[i]["approval"] == "1"
          ? `<td style="text-align: center;">
            <button class="stat-bttn" name="approval">
              Approved
            </button>
          </td>`
          : `<td style="text-align: center;">
            <button
              value=${arr[i]["id"]}
              id="appr_btn"
              class="stat-bttn"
              onclick="updateApprovalStatus(this.value)"
              name="approval"
            >
              Approval
            </button>
          </td>`
      }
    </tr>`;
  }
  table += `</table>`;
  document.getElementById("table").innerHTML = table;
}

/*
The actual append function for the client dropdown
*/
function getAllClients(arr) {
  let options = "";
  for (let i = 0; i < arr.length; i++) {
    options += `<option value="${arr[i]["client"]}">${arr[i]["client"]}</option>`;
  }
  return options;
}

/*
The actual append function for the title dropdown
*/
function getAllCampaigns(arr) {
  let options = "";
  for (let i = 0; i < arr.length; i++) {
    options += `<option value="${arr[i]["id"]}">${arr[i]["campaign_name"]}</option>`;
  }
  return options;
}

/*
Get the distinct client and title values from the DB and append them to the multiselect client and title dropdown
*/
$(window).on("load", () => {
  // First AJAX call to get the clients
  $.ajax({
    url: "includes/getclients.php",
    type: "POST",
    data: {
      getAllClients: "getAllClients",
    },
  }).done((resp) => {
    let r = JSON.parse(resp);
    // console.log(r)
    let opt = getAllClients(r);
    $("#clients").html(opt);
    $("#clients").multiselect("rebuild");
  });

  // Second AJAX call to get the titles

  $.ajax({
    url: "includes/getcampaigns.php",
    type: "POST",
    data: {
      getAllCampaigns: "getAllCampaigns",
    },
  }).done((resp) => {
    let r = JSON.parse(resp);
    // console.log(r)
    let opt = getAllCampaigns(r);
    $("#campaigns").html(opt);
    $("#campaigns").multiselect("rebuild");
  });
});

/*
This part controls the multiselect dropdown
*/
$("#clients").multiselect({
  selectAllValue: "multiselect-all",
  disableIfEmpty: true,
  enableFiltering: true,
  maxHeight: 300,
  buttonText: function (options) {
    if (options.length == 0) {
      return "Select clients";
    } else if (options.length >= 1) {
      return options.length + " selected"; // This shows how many clients have been selected
    }
  },
  onChange: function (element, checked) {
    let options = $("#clients option:selected");
    let selected = [];
    $(options).each(function (i, option) {
      selected.push($(this).val()); // Here we push the selected values into an array
    });
    clients = selected; // The array which we pass into the AJAX code
    updateTitlesOnChange();
    // console.log(clients)
  },
});

$("#campaigns").multiselect({
  selectAllValue: "multiselect-all",
  disableIfEmpty: true,
  enableFiltering: true,
  maxHeight: 300,
  buttonText: function (options) {
    if (options.length == 0) {
      return "Select campaigns";
    } else if (options.length >= 1) {
      return options.length + " selected";
    }
  },
  onChange: function (element, checked) {
    let options = $("#campaigns option:selected");
    let selected = [];
    $(options).each(function (i, option) {
      selected.push($(this).val());
    });
    campaigns = selected;
    // console.log(campaigns)
  },
});

/*
The actual form submit, sends all the data and returns in JSON format for admin
*/
$("#form").on("submit", (e) => {
  e.preventDefault();

  let formdata = {};

  formdata["datefrom"] = document.getElementById("datefrom").value;
  formdata["dateto"] = document.getElementById("dateto").value;
  formdata["clients"] = JSON.stringify(clients);
  formdata["campaigns"] = JSON.stringify(campaigns);

  $.ajax({
    url: "includes/getdata.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    let r = JSON.parse(resp);
    if (r.errors) {
      document.getElementById("table").innerHTML =
        '<div style="font-size:4rem;">' + r.errors + "</div>";
    } else {
      showRecordsForAdmin(r);
    }
  });
});

/*
The actual form submit, sends all the data and returns in JSON format for admin
*/
$("#form2").on("submit", (e) => {
  e.preventDefault();

  let formdata = {};

  formdata["datefrom"] = document.getElementById("datefrom").value;
  formdata["dateto"] = document.getElementById("dateto").value;
  formdata["clients"] = JSON.stringify(clients);
  formdata["campaigns"] = JSON.stringify(campaigns);

  $.ajax({
    url: "includes/getdata.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    let r = JSON.parse(resp);
    if (r.errors) {
      document.getElementById("table").innerHTML =
        '<div style="font-size:4rem;">' + r.errors + "</div>";
    } else {
      showRecordsForHC(r);
    }
  });
});

/*
The actual form2 submit, sends all the data and returns in JSON format for client.php
*/

$("#form3").on("submit", (e) => {
  e.preventDefault();

  let formdata = {};

  formdata["datefrom"] = document.getElementById("datefrom").value;
  formdata["dateto"] = document.getElementById("dateto").value;
  formdata["campaigns"] = JSON.stringify(campaigns);

  console.log(formdata);

  $.ajax({
    url: "includes/getclientdata.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    let r = JSON.parse(resp);
    if (r.errors) {
      document.getElementById("table").innerHTML =
        '<div style="font-size:4rem;">' + r.errors + "</div>";
    } else {
      showRecordsForClient(r);
    }
  });
});

$("#form4").on("submit", (e) => {
  e.preventDefault();

  let formdata = {};

  formdata["datefrom"] = document.getElementById("datefrom").value;
  formdata["dateto"] = document.getElementById("dateto").value;
  formdata["clients"] = JSON.stringify(clients);
  formdata["campaigns"] = JSON.stringify(campaigns);

  $.ajax({
    url: "includes/getdata.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    let r = JSON.parse(resp);
    if (r.errors) {
      document.getElementById("table").innerHTML =
        '<div style="font-size:4rem;">' + r.errors + "</div>";
    } else {
      showRecordsForVeena(r);
    }
  });
});

/*
Update the Titles dropdown based on date
*/
$("#datefrom").on("change", () => {
  updateTitlesOnChange();
});

$("#dateto").on("change", () => {
  updateTitlesOnChange();
});

/*
The function to change the Titles based on date on main page
*/
function updateTitlesOnChange() {
  let formdata = {};

  formdata["datefrom"] = document.getElementById("datefrom").value;
  formdata["dateto"] = document.getElementById("dateto").value;
  formdata["clients"] = JSON.stringify(clients);

  // console.log(formdata)

  $.ajax({
    url: "includes/getcampaigns.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    let r = JSON.parse(resp);
    // console.log(r)
    let opt = getAllCampaigns(r);
    $("#campaigns").html(opt);
    $("#campaigns").multiselect("rebuild");
  });
}

/*
The function to change the Titles based on date on client page
*/

function updateTitlesOnChangeForClient() {
  let formdata = {};

  formdata["datefrom"] = document.getElementById("datefrom").value;
  formdata["dateto"] = document.getElementById("dateto").value;
  formdata["campaigns"] = JSON.stringify(campaigns);

  // console.log(formdata)

  $.ajax({
    url: "includes/getcampaigns.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    let r = JSON.parse(resp);
    // console.log(r)
    let opt = getAllCampaigns(r);
    $("#campaigns").html(opt);
    $("#campaigns").multiselect("rebuild");
  });
}

/*
The function to change the status of the titles for main page (Gati only)
*/

function updateStatus(id) {
  let formdata = {};
  let status = document.getElementById(id).value;
  if (status !== "staging" && status !== "active") {
    status = "staging";
  } else {
    status = document.getElementById(id).value;
  }

  formdata["id"] = id;
  formdata["status"] = status;
  formdata["datefrom"] = document.getElementById("datefrom").value;
  formdata["dateto"] = document.getElementById("dateto").value;
  formdata["clients"] = JSON.stringify(clients);
  formdata["campaigns"] = JSON.stringify(campaigns);

  $.ajax({
    url: "includes/updatestatus.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    let r = JSON.parse(resp);
    // console.log(r)
    showRecordsForAdmin(r);
  });
}

function updateApprovalStatus(id) {
  let formdata = {};
  formdata["id"] = id;
  console.log(formdata);
  $.ajax({
    url: "includes/approval.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    // let r = JSON.parse(resp);
    console.log(resp);
    if (resp) {
      document.querySelector("#appr_btn").innerHTML = "Approved";
    }
  });
}

function updateRemark(id) {
  let formdata = {};

  if (team === "Garud") {
    let textarea = document.getElementById(id);
    formdata["id"] = id;
    formdata["remark"] = textarea.value;
    formdata["status_v"] = "staging";
  } else if (team === "Veena") {
    let status = document.getElementById("status_v");
    let textarea = document.getElementById(id);

    formdata["id"] = id;
    formdata["remark"] = textarea.value;
    formdata["status_v"] = status.value;
  }

  console.log(formdata);

  $.ajax({
    url: "includes/updateRemark.php",
    type: "POST",
    data: formdata,
  }).done((resp) => {
    // let r = JSON.parse(resp);
    // console.log(resp);
  });
}
