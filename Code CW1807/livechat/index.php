<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Live Chat</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f8ff;
            font-family: Arial, sans-serif;
        }

        #chat-box {
            width: 100%;
            height: 400px;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAL4AAACUCAMAAAAanWP/AAABoVBMVEX////x6OrRCAhBS+n07O//nQAwfOw+SOn9/Pz/fgDSAADP6vX8+fo8Run59fbPAABzNQD/lwDEAAD39PHm2ddMVerr4ODh0s7x6+fHrp3p4NrZx8DSvbTVxLf/rgCZnvSKkPJude6Sl/O4AADOuaq7nIZvKwD/kABXX+xjau2DifGjqPXl7/zDqJPTraTbzcHD0NPG3OP/hgDriwDgYACcvfZ7gfA7gu00P+hMje+woLbR0eAxWerNytLPn5fDeG+7Wki8Pi68JhK9SzvAbmLGjoW/TEXEn5GwT0W3hXSjGwCjUDO3KRytYU2rMSa4dWW/ua+lcFSlPDizvbuvqZypg2p2OSSRZFKvjHxpGACKVjGDSx9iCAB/SC5/SDnAjWXOkV7ck0znlzq2civchRfUoovFVQDGfU/XdjLhcgCxXx7SeEGpp+OQjtSjjZ+SgYF+fNaMcoFsjdNsas64wtxXUcbalXI/QcqBnNF3XYtkVra1oqlvWqAxcetxoPGAbabRzvSSfp2oSQCaqMlZP4q2z/ikq7q3tOCYjsI4Yb9Ees6FBx9kAAAPGElEQVR4nO1c+1vbRhaVKsUaElkQS9ZjJNUPZGJjO0pSY5sY2iZN1ps0bWFbbxy6XSfbACEhaUoh0KZKoV1Ky1+9M3r4AQYMJKPu93F+SIyRxbl3zr1z587IFHWGM5zhDGc4wxnOcIYznOEMbxEgbAIngggl3bjswlCgKobN5xgA0Pjwo49v3BwdjSGM3rz3ya3bl+3/EwtU86O/3YzFhs8jvPfee/i/4eFY7MatOgyb2tEA2t9vDg9j3r3AJnx+5y9ugFq/Gzu/n3tgwvnRT+FfN5RF/ePYgdw9DN+7/VcdAXj7Zh/V7B2B2MdG2ET7wjrS9cEAaGFT3Q+xeXN4EPKY/+idv1oShZ8N5npfQAF/gBAucZeF8fmgrg/4qxTFq7ZlaZYd6pQsipRYHz0We4TRD9H0hpmL2AY1NPImwhfHEE7g/3v1mSu8dw8ANTsc9kDTZVm6M3oM3fuXxmavFtq3UTUlFPYZhaVpmr08uHju3h1166FPrl7gOzdStRD0A4ouexpQ5iexgcgPxyzRNrXmnc++unChO+coJvEMBAzdZY+9qN8aiP/5m37JYF/ppS+Sdz80MHmadX9Q7wwioPOfe0kSmIg+330z4tlHNKW28/GPl28MUPF86l3Mm1cvXCh0380kTT9wflsD0mdHZqDhO96lwMb0u9Vjki5EocH20qeA9Y/hwxUUq/tXYvH0uJ+4eBR9L32koPqN2GEGxIJiWcH0u/iTD13Yhz4FlNs3DpmDR4PpVZy56vIPPgwNniILX/u00Pu2qNy+d9AInG/Tp+CXF1z+2AAACjPE12CiIbOdxNkFAOt3R/uueM+PdlgaHn8PX5pEqbuwvdjdzx+H5hf3Yuf3mdBNnzI7/L8iz141Nb9m2CsfD7D+xd9uxoaHAxtwv6eHPqXMXLly9erVK19q5Ffv0DJoWTuMPyVC4/atT+7FUIk27Hbbbty4a3YvTVD5MzMzYyrklyu2haZcVraMw/gjqFC//OFHt259dLtu6Iqi21ZvaS+KpDMO/qOWTruVMm1ZtBe/h7AAIoaXIoFqhd7nwewDGJp8xADsATQGvfIdQdS8CctLO1LRz/+sMFjJHrL7gdXFHgvI0PSjFdSBTX5l0gVg9rB3B8CwjmGAqoVJ3zbovWBZaKIcOqABoBhCsgkArX3kcSgC0cwEI3BUaGrhxW6wxOrh7gHYRUPyLBAO9W8YXQUfQZ2DFcPurZZFWzMUSXZ/IfAHKlwLrSkoanJAXjekPjKBpmnprgEHWxCe9v3WCM0qjX9+c79va0+EtoUTkW/B/gtULSz6fNH3vZyBzbGx+weoQFRtVI0GY7B3CKyQGppI+YHztSKljI082D9/CqoKeOxd0chYUr/JQLHCkr5YDOK2OWc3EP19jVXz63+NZUSBdVUPLc2QZLonkkU7NPZBawTTHxsZGxkZ2ZsBYREb1aQEP6hFyTZ0XcEmIAN4QbYtM7y9CEsJ0n19DLEfa+6hIhYBREaNiVQnZFUITcMyMCxDK4aX8lHCloOcr3/zYOxf3+h7ohLOAhQRIw/03rdFUUVGQCjTMMw9RdipdlilOZuR96Z9+G88KCMPDtq45flMiNtYSmeR4vZl96VveB+z75eQAoSwKG/DVtge+vsAGpj+2NzBBbEeWs5Hhb5Hn8XgRRlKioIqHLWLLBx5MPZg7MBNfx7lUhJM+wK4xSbLyrqVaT18+OjRo/8gPHr0sFW0263Kxlxjb0B33QGoRUJk+/xxTJ/VW98+fnwR4f33z73v4tzFi49bQUIE4mFLKV7MkGDaF6jUR863li6eQ4TPncP/XvRenDv3QWugJQgvhud9UXdXKvWla9iASz5xH48HSilhep/3tC/PLw1duxS4PjDi8UAphQ9b+7gxMl8a8gy4dOlSIJ8PBnIrr4Y47ZpB3tcWhpABmDeywKN/sTXIHXgY4kkqO6jYWH1xCMOl7tN/ePTnAQB2eNMWBdtFAyvNP3ENuBaknkG8j0r+EJsMlNpVsqEBWBryLLiETfhggJhEBX8xzAabJdMdAyRrsTTkW3Dt2tLRqkCLyBBrBoSe7iZLy9a3gQFDz45WhQB44lvnPVC13uYsK2tPPQktWUc3PwQQwrGRHlhdJbNA8YLAC2br2dLSk+LRuxMCAHqorfFe9wf9QSRotAYuHOV9XqDY0PeFtB73BwD84T1ZfAlSPgyvR+JD1drs5b6dfPEAdQsCJYS5UvTR7jCzisT2UbKaAf2s4gVAmQS3zq26N9A9TWK+tvz8RVs+itLnNACcNfsICbOH39HviGsfZBbmsQyA1uUyYTleLb/cau9PKLrc63+gmpn7DWVfEkLCp9TvIys1YolHbC3gBaDYmm//SX6ZqaaT8fUXasBfMvSuhbqqZxpNU1XMfjlUrf/gRHZXifFXW6VXKiW05ttS2MxWU4l4lFv/Dgb8Zcm0LFOBNlq9NzNFG2LF9aOovlhLTEQiuxIp+pS6WGqJfOtVkOz45Wo2n4syTDXVhF2zrwzxMWYbwkMW6er369UsmHAiG2RSJ6xrWnOhtCi+WgwyYSFVHU9WGSaazad+9DcR3RR09E6o/WMVmZ0sIP93he87PLkP661nC0tLpdZih348m0DO5+LpcjT60+uuDcYjDFBf/5xkOM5x8oU3zu8d9tq7nMVEaJvmYmmhTb/GlccZhHIacYmu/aJ3FNR3Cysgb/yxzqTLXDwSSW1uRzbw7h12u1js3PpdAT4tdejHk6koE83hIcAS+uOFoR5pALC21qJcNJfOOpGKkyy8QfSLv+LUVCwtWe88D8FnpSBzFsrjWY5hxt0hiMYTOW5ty4LCYRaoVnONQZ9BgnsTiVQmnYkLv6Ep5VfkEW2pRKLloy4u+MtAsFmOu37EfJjkeJWJVqP/fW1I7trRX0K2J2kgQv37/1bLKTxUHJcvTCL+lfGCSIH5EqQsFFYE2CP/v1rwVnii/jzO+frnUsk4hwchlVj7eev6tCJJsqyqsizTKgKUp19v/bwejUazaXxZ3JmsvYlMViazmzZA9G3lydBTy75sEEijyP+4gQwsffplnMH6R2Jw/3NzaDVara7/9Mv1ra3rCC9eoxc//vzTDy+rUTxK0Xw2yiDdOyhqEX3n+Ywtzpcyz4aGSgsLn9ZJzALqq6doHW7pLDu9MoWm3S7nJ9OutLloOR1n1hHWnq/hH6PeIKEpLpGaciKRiLNTqCDx7K7WZuz50tOhJ4uv5k1IZg5TZxeh7q7SpeebOY7DznfZ59xZ2A3NMmLNcaiqwPYEAc5w1fwEZh9xElj8k7/VarWZxaGhJ4Yoklu6qF986q8S4WrEyXHZRDbqxa/L1bXDfYVKuqpnjmsfk2M2axEXKGc6Fcy+Nj07VCLc6YTtLVH4+y7K33mPtGsFRnI8MMN9h8umc0w861QqU8vY6wjlwsTu75h9rb5U+oose75zBkmVlv90Niec3BSaf8uMzzrhOZ8ZT2ANod/slB0kmsnKVN6n72zWaniOYF8/Kd0n/JCW0ukOrj5P/DC1+gYTSi2X4zhuOVTKISWhiM3my9zUVM7xfV6ZnGzTX0EZn+JlVnmyNF/7imi7BxQln7y4E2fK+VTuT8TJSW9OOo6Ty8WzO+WpqalsjskXIjhQK9nCtsfep++srOJKExRqwsNSS6aniWo/OAZDq39UcQGTH+fW/9zNLW97UTlV2/ayS7ngveMkAR6eSUx/GSXMDcmbi4Uamym1UKHEWgTl0z4Go66WGbxcyabTuej62o6fE8f5imfGsss6EmFqvmLQezv0KnRLewGAWkErLaJXaIlDsOPT3lTZSeaTWRSZ0Xg5Xc4yL3/bWKmgPLo90ev8XIqaiLjiebOxQyPH86gWEgSKrRlP3PoV8deJuV8MGoO1FJPKJ1JoADguW84vT6vq9Opvu/lVV/AOt+n53GE2hUplZWVitYa5AwEf5UHsRcNcXPQaVQItETvW0z7J8DzKcbl0PpmLRjlUhLk7Rapck6dXNzY2UCgIE7u7uysrKzuqWqsV3B4W5o49j89SqdrcZ0GbjaUNQskHGP6MNY3LHKSbfH48zjjORvdqHaFGS/K0gipOwXv8HPCse4QKtFtdYqYRcOZZ3SbTM5H8nK++rHpVDMqcy5sTKxLdBRb5d8+hzX4LcTvwPmBpQmdRg+1EKe4XCFw0niwIsJv7oOcygwsFSmANIv1a/yQASprjOc6rDBjGmdyQj0++AxYpS9GPvu70CHYT1eV8ohzHSxCGm4pE2vQHe+JgDwQBsDKR4wHB+TU5lchjA6oobTqRyqrqsz/RTXkWsGyRhPj95yrV1SqDDciP5xgGFWDygc/LDQKepVgi4gd+1leXUUEZTyWRBenEm8kN3/cnTH6u90kcaxOCrP8SL6+i0Ww5mShQhemT6x4D06dlAmWn6D/qISejbt5E8202v73t2XTiZzh4FLo0TSB2Rcs7PCgvo2LTzZvcFIrc2qmcTwGKRx8nR5+GKG/mGDwCXBZV8tOniFsXAqb/7ssG1fIOUOnXywmUN7O40R3QP80zECTps7KmKevZ8XQ+n0zlJicrlWls1Cn+OpY+S+DpM0TfyBiNjJK5zkSzqfF0Il+rbW+79dopbgtoQvQNwRgZa0qZuvhjFc248WzqzcTE25A+sdCVabnZUDOZ1VwVgXH+3JJPS98NKAL9fZT3WaXx9X1Jm+Vh5vofP6W3Zhp6/y8IGBy8O2uQ8L4hs/r9uqx/o7BaRigW1aI+60/EJ5euqx0SRzpxzYPSZn0uw8oNnZ6TlYzyb7/tc/LEiT8vQBInNHDFyRZnNVrINAVrTlAaUqMpnI6+qx1A5GyS96yTzEqNOYVvNgS9IVtz9OlKHlc7VIbEo3+qV3Ki+JXo5ojO1pus9LXU57tVjgFXO2QOY4u2FOwaSk2NVeYMVvHpn1Q97pRLEToO3D647NY+sk6zRpM+lXoQfVYg9XVCsPfRdOQ5SQ7Og51MPQCPm0iozwO6T/7uwQndjxtaxI6SK11nH/fgxMFL8cSOdIragfRPnjuhSeyJ6X1fK9GFk7YaTHLbK6B4IPuTul9992dhOlCMty0fooeZQVF+u9FL+PGn/V/scTr+GbLn4IF9SPQemz+ZWrMboiUdSP/Y8rfJP8ACiwe7/5j8Q/neVsV6S/zFk0vnf0yaGbNdkGZXAAAAAElFTkSuQmCC');
            background-size: cover;
            padding: 15px;
            border-radius: 8px;
            overflow-y: auto;
            position: relative;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Hiệu ứng làm mờ nền */
            backdrop-filter: blur(8px);
            /* Độ mờ của ảnh nền */
            background-blend-mode: darken;
            opacity: 0.5;
            /* Độ trong suốt của box */
        }

        .message {
            padding: 10px;
            border-radius: 15px;
            margin-bottom: 10px;
            max-width: 70%;
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        .message.left {
            background-color: rgba(0, 123, 255, 0.5);
            align-self: flex-start;
        }

        .message.right {
            background-color: rgba(40, 167, 69, 0.5);
            align-self: flex-end;
        }

        .message small {
            display: block;
            font-size: 0.8rem;
            color: #ccc;
            text-align: right;
        }

        #message-form {
            display: flex;
            margin-top: 15px;
        }

        #message-form input[type="text"] {
            border-radius: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            flex: 1;
            margin-right: 5px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center my-4 text-primary">Live Chat </h1>
        <div id="chat-box" class="d-flex flex-column"></div>
        <form id="message-form" class="mt-3">
            <input type="text" id="username" placeholder="Tên của bạn" required class="form-control">
            <input type="text" id="message" placeholder="Tin nhắn" required class="form-control">
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadMessages() {
            $.get("load_messages.php", function(data) {
                $("#chat-box").html(data);
                $("#chat-box").scrollTop($("#chat-box")[0].scrollHeight);
            });
        }

        $("#message-form").submit(function(e) {
            e.preventDefault();
            const username = $("#username").val();
            const message = $("#message").val();
            $.post("send_message.php", {
                username: username,
                message: message
            }, function() {
                $("#message").val("");
                loadMessages();

                // Hiệu ứng khi gửi tin nhắn
                $("#chat-box").animate({
                    scrollTop: $("#chat-box")[0].scrollHeight
                }, 300);
            });
        });


        setInterval(loadMessages, 2000);
    </script>
</body>

</html>