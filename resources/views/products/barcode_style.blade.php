<style>
.bar_code_lis {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-gap: 10px;
    margin-bottom: 20mm;
}

.bar_code_lis > div {
    margin: 5px;
    padding: 8px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background: #fff;
}

.bar_code_lis > div span {
    display: block;
    margin-top: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #0f172a;
    word-break: break-word;
}

@media print {
    .bar_code_lis > div {
        border: 1px solid #c0bfbf;
        border-radius: 0;
    }
}
</style>
