<style>
    .bar_code_lis{
    display: grid;
    /*Using the full width/height of the designated box elements, use fr as in example below */
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-template-rows: 1fr 1fr 1fr 1fr 1fr;
    /*Delete the two lines above and add more/less columns/rows by specifying one more for each below */
    /* grid-template-columns: 100px 100px 100px;
    grid-template-rows: 100px 100px 100px; */
    grid-gap: 10px;

}
.bar_code_lis >div{
    margin: 5px;
    padding: 5px;
    border: 1px solid #c0bfbf;
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: column;
    align-items: center;


}

button.print-button {
    width: 100px;
    height: 100px;
}
span.print-icon, span.print-icon::before, span.print-icon::after, button.print-button:hover .print-icon::after {
    border: solid 4px #333;
}
span.print-icon::after {
    border-width: 2px;
}

button.print-button {
    position: relative;
    padding: 0;
    border: 0;

    border: none;
    background: transparent;
}

span.print-icon, span.print-icon::before, span.print-icon::after, button.print-button:hover .print-icon::after {
    box-sizing: border-box;
    background-color: #fff;
}

span.print-icon {
    position: relative;
    display: inline-block;
    padding: 0;
    margin-top: 20%;

    width: 60%;
    height: 35%;
    background: #fff;
    border-radius: 20% 20% 0 0;
}

span.print-icon::before {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 12%;
    right: 12%;
    height: 110%;

    transition: height .2s .15s;
}

span.print-icon::after {
    content: "";
    position: absolute;
    top: 55%;
    left: 12%;
    right: 12%;
    height: 0%;
    background: #fff;
    background-repeat: no-repeat;
    background-size: 70% 90%;
    background-position: center;
    background-image: linear-gradient(
    to top,
    #fff 0, #fff 14%,
    #333 14%, #333 28%,
    #fff 28%, #fff 42%,
    #333 42%, #333 56%,
    #fff 56%, #fff 70%,
    #333 70%, #333 84%,
    #fff 84%, #fff 100%
    );

    transition: height .2s, border-width 0s .2s, width 0s .2s;
}

button.print-button:hover {
    cursor: pointer;
}

button.print-button:hover .print-icon::before {
    height:0px;
    transition: height .2s;
}
button.print-button:hover .print-icon::after {
    height:120%;
    transition: height .2s .15s, border-width 0s .16s;
}

</style>
