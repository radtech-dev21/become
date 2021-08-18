module.exports.successResponse = (message, data = {}) => {
    return {"status": "success", "message": message, data: data, code: 200};
};

module.exports.errorResponse = (message, code = 400) => {
    return {"status": "error", "message": message, code: code, data: {}};
};

module.exports.isEmpty = (newVar) => {
    return typeof newVar == "undefined";
}
