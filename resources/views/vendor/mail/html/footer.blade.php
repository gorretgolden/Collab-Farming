<tr class="tr-footer">
    <td>
        <table class="footer" align="center" width="800" cellpadding="0" cellspacing="0" role="presentation">
            <tr style=" color: #aeaeae;">
                <td class="content-cell" align="center">
                    <div style="height: 5px;"></div>
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                </td>
            </tr>
        </table>
    </td>
</tr>
